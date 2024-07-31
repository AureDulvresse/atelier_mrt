<?php

// Paramètres de la base de données

include 'config/config.php';

class EventController
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function readPost($id)
    {
        try {
            // Préparer la requête de sélection
            $sql = "SELECT * FROM post WHERE id = :id";
            
            // Préparer et exécuter la requête avec les paramètres
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            
            // Récupérer le résultat
            $post = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($post) {
                return $post;
            } else {
                throw new Exception("Post not found.");
            }
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function addPost()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $event_date = $_POST['event_date'];
            $event_place = $_POST['event_place'];
            $thumbnail = $_FILES['thumbnail']['name'];

            // Gestion de l'upload de l'image
            $target_dir = __DIR__ . '/../uploads/';
            $target_file = $target_dir . basename($thumbnail);

            // Créer le répertoire uploads s'il n'existe pas
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Déplacer le fichier uploadé vers le dossier cible
            if (!move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                echo "Désolé, il y a eu une erreur lors de l'upload de votre fichier.";
                return;
            }

            try {
                // Préparer la requête d'insertion
                $sql = "INSERT INTO post (title, slug, description, content, event_date, event_place, thumbnail)
                        VALUES (:title, :slug, :description, :content, :event_date, :event_place, :thumbnail)";
                
                // Préparer et exécuter la requête avec les paramètres
                $stmt = $this->pdo->prepare($sql);
                $params = [
                    ':title' => $title,
                    ':slug' => $slug,
                    ':description' => $description,
                    ':content' => $content,
                    ':event_date' => $event_date,
                    ':event_place' => $event_place,
                    ':thumbnail' => $thumbnail
                ];

                if ($stmt->execute($params)) {
                    echo "Post ajouté avec succès.";
                } else {
                    echo "Erreur lors de l'insertion des données.";
                }
            } catch (PDOException $e) {
                echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
            }
        }
    }

    public function deletePost($id)
    {
        try {
            // Préparer la requête de suppression
            $sql = "DELETE FROM post WHERE id = :id";
            
            // Préparer et exécuter la requête avec les paramètres
            $stmt = $this->pdo->prepare($sql);
            
            if ($stmt->execute([':id' => $id])) {
                echo "Post supprimé avec succès.";
            } else {
                echo "Erreur lors de la suppression du post.";
            }
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
        }
    }

    public function editPost()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $id = $_POST['id'];
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $event_date = $_POST['event_date'];
            $event_place = $_POST['event_place'];
            $thumbnail = $_FILES['thumbnail']['name'];
            
            // Gestion de l'upload de l'image
            if ($thumbnail) {
                $target_dir = __DIR__ . '/../uploads/';
                $target_file = $target_dir . basename($thumbnail);

                // Créer le répertoire uploads s'il n'existe pas
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                // Déplacer le fichier uploadé vers le dossier cible
                if (!move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                    echo "Désolé, il y a eu une erreur lors de l'upload de votre fichier.";
                    return;
                }
            } else {
                // Conserver le thumbnail existant si aucun nouveau fichier n'est uploadé
                $stmt = $this->pdo->prepare("SELECT thumbnail FROM post WHERE id = :id");
                $stmt->execute([':id' => $id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $thumbnail = $result['thumbnail'];
            }

            try {
                // Préparer la requête de mise à jour
                $sql = "UPDATE post SET title = :title, slug = :slug, description = :description, 
                        content = :content, event_date = :event_date, event_place = :event_place, 
                        thumbnail = :thumbnail WHERE id = :id";
                
                // Préparer et exécuter la requête avec les paramètres
                $stmt = $this->pdo->prepare($sql);
                $params = [
                    ':id' => $id,
                    ':title' => $title,
                    ':slug' => $slug,
                    ':description' => $description,
                    ':content' => $content,
                    ':event_date' => $event_date,
                    ':event_place' => $event_place,
                    ':thumbnail' => $thumbnail
                ];

                if ($stmt->execute($params)) {
                    echo "Post modifié avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour des données.";
                }
            } catch (PDOException $e) {
                echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
            }
        }
    }


    
}

?>
