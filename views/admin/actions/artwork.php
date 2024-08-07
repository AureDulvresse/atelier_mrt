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

    // Traitement de l'image uploadée
    if ($image['error'] == 0) {
        $imagePath = 'uploads/artworks/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
    } else {
        $imagePath = null;
    }

    $artwork = new Artwork($title, $description, $price, $category_id, $medium_id, $imagePath)

    if (empty($id)) {
        // Ajouter une nouvelle œuvre
        Artwork->save($title, $description, $price, $category_id, $medium_id, $imagePath);
    } else {
        // Modifier une œuvre existante
        Artwork::update($pdo, $id, $title, $description, $price, $category_id, $medium_id, $imagePath);
    }

    header('Location: artworks.php');
    exit;
}
