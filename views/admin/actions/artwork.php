<?php

use App\Models\Artwork;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $medium_id = $_POST['medium_id'];
    $image = $_FILES['image'];


    if (isset($_POST['delete']) && $_POST['delete'] == true) {
        Artwork::delete($pdo, $id);
    }

    // Traitement de l'image uploadée
    if ($image['error'] == 0) {
        $imagePath = 'uploads/artworks/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
    } else {
        $imagePath = null;
    }

    $artwork = new Artwork($title, $description, $price, $stock, $width, $height, $imagePath, $category_id, $medium_id);

    if (empty($id)) {
        // Ajouter une nouvelle œuvre
        $artwork->save($pdo);
    } else {
        // Modifier une œuvre existante
        $artwork->update($pdo);
    }

    header('Location: /atelier_mrt/admin/artworks');
    exit;
}
