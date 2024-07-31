<?php

class ArtworkController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addArtwork()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $width = $_POST['width'];
            $height = $_POST['height'];
            // $category = $_POST['category'];
            // $medium = $_POST['medium'];

            // Gestion de l'upload de l'image
            $thumbnail = $_FILES['thumbnail']['name'];
            $target_dir = __DIR__ . '/../uploads/';
            $target_file = $target_dir . basename($thumbnail);

            // Créer le répertoire uploads s'il n'existe pas
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Déplacer le fichier uploadé vers le dossier cible
            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                echo "Le fichier " . htmlspecialchars(basename($thumbnail)) . " a été uploadé avec succès.";
            } else {
                echo "Désolé, il y a eu une erreur lors de l'upload de votre fichier.";
                return;
            }

            try {
                // Préparer la requête d'insertion
                $sql = "INSERT INTO artwork (title, slug, description, price, stock, width, height, thumbnail)
                        VALUES (:title, :slug, :description, :price, :stock, :width, :height, :thumbnail)";

                // Préparer et exécuter la requête avec les paramètres
                $stmt = $this->pdo->prepare($sql);
                $params = [
                    ':title' => $title,
                    ':slug' => $slug,
                    ':description' => $description,
                    ':price' => $price,
                    ':stock' => $stock,
                    ':width' => $width,
                    ':height' => $height,
                    ':thumbnail' => $thumbnail,
                    // ':category' => $category,
                    // ':medium' => $medium,
                ];

                if ($stmt->execute($params)) {
                    echo "Nouvelle œuvre créée avec succès.";
                } else {
                    echo "Erreur lors de l'insertion des données.";
                }
            } catch (PDOException $e) {
                echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
            }
        }
    }

    public function deleteArtwork($id)
    {
        try {
            // Préparer la requête de suppression
            $sql = "DELETE FROM artwork WHERE id = :id";

            // Préparer et exécuter la requête avec le paramètre ID
            $stmt = $this->pdo->prepare($sql);
            $params = [
                ':id' => $id
            ];

            if ($stmt->execute($params)) {
                echo "Œuvre supprimée avec succès.";
            } else {
                echo "Erreur lors de la suppression de l'œuvre.";
            }
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
        }
    }

    public function editArtwork($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $width = $_POST['width'];
            $height = $_POST['height'];

            // Gestion de l'upload de l'image
            $thumbnail = $_FILES['thumbnail']['name'];
            $target_dir = __DIR__ . '/../uploads/';
            $target_file = $target_dir . basename($thumbnail);

            if (!empty($thumbnail)) {
                // Créer le répertoire uploads s'il n'existe pas
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                // Déplacer le fichier uploadé vers le dossier cible
                if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                    echo "Le fichier " . htmlspecialchars(basename($thumbnail)) . " a été uploadé avec succès.";
                } else {
                    echo "Désolé, il y a eu une erreur lors de l'upload de votre fichier.";
                    return;
                }
            }

            try {
                // Préparer la requête de mise à jour
                $sql = "UPDATE artwork 
                        SET title = :title, slug = :slug, description = :description, price = :price, 
                            stock = :stock, width = :width, height = :height";
                if (!empty($thumbnail)) {
                    $sql .= ", thumbnail = :thumbnail";
                }
                $sql .= " WHERE id = :id";

                // Préparer et exécuter la requête avec les paramètres
                $stmt = $this->pdo->prepare($sql);
                $params = [
                    ':title' => $title,
                    ':slug' => $slug,
                    ':description' => $description,
                    ':price' => $price,
                    ':stock' => $stock,
                    ':width' => $width,
                    ':height' => $height,
                    ':id' => $id
                ];
                if (!empty($thumbnail)) {
                    $params[':thumbnail'] = $thumbnail;
                }

                if ($stmt->execute($params)) {
                    echo "Œuvre mise à jour avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour de l'œuvre.";
                }
            } catch (PDOException $e) {
                echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
            }
        }
    }


}
