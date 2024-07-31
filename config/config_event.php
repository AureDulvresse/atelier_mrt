<?php

// Paramètres de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'ateliermrtdb');
define('DB_USER', 'root');
define('DB_PASS', ''); 

// Créer une instance de PDO pour la connexion à la base de données
try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $lieu = $_POST['lieu'];

    try {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO store_event (name, description, date, lieu)
                VALUES (:name, :description, :date, :lieu)";

        // Préparer et exécuter la requête avec les paramètres
        $stmt = $pdo->prepare($sql);
        $params = [
            ':name' => $name,
            ':description' => $description,
            ':date' => $date,
            ':lieu' => $lieu
        ];

        if ($stmt->execute($params)) {
            echo "Nouvel événement créé avec succès.";
        } else {
            echo "Erreur lors de l'insertion des données.";
        }
    } catch (PDOException $e) {
        echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage(); 
    }
}
?>
