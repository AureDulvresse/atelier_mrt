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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    // $category = $_POST['category'];
    // $medium = $_POST['medium'];
    //hi
    // Gestion de l'upload de l'image
    $thumbnail = $_FILES['thumbnail']['name'];
    $target_dir = __DIR__ . '/../uploads/';
    $target_file = $target_dir . basename($thumbnail);

<<<<<<< HEAD
    // Créer le répertoire uploads s'il n'existe pas
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Déplacer le fichier uploadé vers le dossier cible
    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
        echo "Le fichier " . htmlspecialchars(basename($thumbnail)) . " a été uploadé avec succès.";
    } else {
        echo "Désolé, il y a eu une erreur lors de l'upload de votre fichier.";
    }

    try {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO store_artwork (title, slug, description, price, stock, width, height, thumbnail)
                VALUES (:title, :slug, :description, :price, :stock, :width, :height, :thumbnail)";

        // Préparer et exécuter la requête avec les paramètres
        $stmt = $pdo->prepare($sql);
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
?> -->
=======
// Vérifiez que l'initialisation s'est bien déroulée
// if ($auth) {
//     echo 'PHPAuth a été initialisé avec succès.';
// } else {
//     echo 'Erreur lors de l\'initialisation de PHPAuth.';
// }
>>>>>>> 667d71639667b707b4e7ffd105a9457becf22a71
