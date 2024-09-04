<?php

use App\Models\Artwork;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données de l'œuvre d'art depuis le formulaire
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $stock = $_POST['stock'];
    $medium_id = $_POST['medium_id'];
    $image = $_FILES['image'] ?? null;

    // Gestion des actions (ajout, modification, suppression)
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Traitement de l'image uploadée
        $imagePath = null;
        if ($image && $image['error'] == 0) {
            $imagePath = 'uploads/artworks/' . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        // Si une image n'a pas été uploadée, récupérer l'image actuelle (pour modification)
        if (!$imagePath && !empty($id)) {
            $artwork = Artwork::find($pdo, $id);
            $imagePath = $artwork ? $artwork->thumbnail : null;
        }

        switch ($action) {
            case 'add':
                // Ajouter une nouvelle œuvre
                $artwork = new Artwork($title, $description, $price, $stock, $width, $height, $imagePath, $medium_id);
                $artwork->save($pdo);
                break;

            case 'edit':
                // Modifier une œuvre existante
                $artwork = new Artwork($title, $description, $price, $stock, $width, $height, $imagePath, $medium_id);
                $artwork->id = $id;
                $artwork->update($pdo);
                break;

            case 'delete':
                // Supprimer une œuvre
                Artwork::delete($pdo, $id);
                break;
        }

        // Redirection après l'action
        header('Location: /atelier_mrt/admin/artworks');
        exit;
    }
}
