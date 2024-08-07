<?php

use App\Models\Artwork;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    Artwork::delete($pdo, $id);

    header('Location: /atelier_mrt/admin/artworks');
    exit;
}
