<?php

class CategorieController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function readCategories() {
        global $pdo;
        
        try {
            $sql = "SELECT * FROM category";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur lors de la lecture : ' . $e->getMessage();
            return [];
        }
    }

    // Affichage des catégories
    // $categories = readCategories();
    // foreach ($categories as $category) {
    //     echo "<p><strong>Name:</strong> " . htmlspecialchars($category['name']) . "<br>";
    //     echo "<strong>Description:</strong> " . htmlspecialchars($category['description']) . "</p>";
    // }



    function addCategorie($name, $description) 
    {
        global $pdo;
        
        try {
            $sql = "INSERT INTO category (name, description) VALUES (:name, :description)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':name' => $name, ':description' => $description]);
            echo "Catégorie ajoutée avec succès.";
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'insertion : ' . $e->getMessage();
        }
    }
    
    // Appel de la fonction pour ajouter une catégorie
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     createCategory($_POST['name'], $_POST['description']);
    // }
    // deleteCategory.php


    function deleteCategorie($id) 
    {
        global $pdo;
        
        try {
            $sql = "DELETE FROM category WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            echo "Catégorie supprimée avec succès.";
        } catch (PDOException $e) {
            echo 'Erreur lors de la suppression : ' . $e->getMessage();
        }
    }

    // Appel de la fonction pour supprimer une catégorie
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     deleteCategory($_POST['id']);
    // }

    function editCategorie($id, $name, $description) 
    {
        global $pdo;
        
        try {
            $sql = "UPDATE category SET name = :name, description = :description WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id, ':name' => $name, ':description' => $description]);
            echo "Catégorie mise à jour avec succès.";
        } catch (PDOException $e) {
            echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
        }
    }

    // Appel de la fonction pour mettre à jour une catégorie
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     updateCategory($_POST['id'], $_POST['name'], $_POST['description']);
    // }




}
