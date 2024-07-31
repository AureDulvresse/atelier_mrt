<!-- <?php

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

// Vérifiez que l'initialisation s'est bien déroulée
// if ($auth) {
//     echo 'PHPAuth a été initialisé avec succès.';
// } else {
//     echo 'Erreur lors de l\'initialisation de PHPAuth.';
// }
