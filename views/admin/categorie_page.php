<?php


use App\Models\Category;

$categories = Category::all($pdo);

include 'includes/sidebar.php';
?>
<div class="main-content">
    <header class="header">
        <h3>Toutes les Catégories</h3>
    </header>

    <!-- Formulaire pour ajouter/modifier une œuvre -->
    <div class="table-container">
        <div class="table-card">
            <div class="table-header">
                <h5>Catégories</h5>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $categorie) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($categorie->name); ?></td>
                            <td><?php echo htmlspecialchars($categorie->description); ?></td>
                            <td>
                                <button onclick="editArtwork(<?php echo htmlspecialchars(json_encode($categorie)); ?>)"><i class="bx bx-pencil"></i></button>
                                <button onclick="deleteArtwork(<?php echo $categorie->id; ?>)"><i class="bx bx-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>