<?php

namespace App\Controllers;

use App\Models\Artwork;

class ArtworkController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function list()
    {
        return Artwork::all($this->pdo);
    }

    public function find($id)
    {
        $artwork = Artwork::find($this->pdo, $id);

        if ($artwork) {
            return $artwork;
        } else {
            echo json_encode(["message" => "Artwork not found."]);
        }
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $width = $_POST['width'];
            $height = $_POST['height'];
            $category_id = $_POST['category_id'];
            $medium_id = $_POST['medium_id'];

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

            // Créer une nouvelle instance de Artwork et sauvegarder
            $artwork = new Artwork($title, $description, $price, $stock, $width, $height, $thumbnail, $category_id, $medium_id);
            if ($artwork->save($this->pdo)) {
                echo "Nouvelle œuvre créée avec succès.";
            } else {
                echo "Erreur lors de l'insertion des données.";
            }
        }
    }

    public function delete($id)
    {
        if (Artwork::delete($this->pdo, $id)) {
            echo "Œuvre supprimée avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'œuvre.";
        }
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $width = $_POST['width'];
            $height = $_POST['height'];
            $category_id = $_POST['category_id'];
            $medium_id = $_POST['medium_id'];

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

            // Récupérer l'œuvre existante
            $artwork = Artwork::find($this->pdo, $id);
            if ($artwork) {
                $artwork->title = $title;
                $artwork->slug = slugify($title);
                $artwork->description = $description;
                $artwork->price = $price;
                $artwork->stock = $stock;
                $artwork->width = $width;
                $artwork->height = $height;
                if (!empty($thumbnail)) {
                    $artwork->thumbnail = $thumbnail;
                }
                $artwork->category_id = $category_id;
                $artwork->medium_id = $medium_id;
                $artwork->updated_at = date('Y-m-d H:i:s');

                if ($artwork->update($this->pdo)) {
                    echo "Œuvre mise à jour avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour de l'œuvre.";
                }
            } else {
                echo "Œuvre non trouvée.";
            }
        }
    }
}
