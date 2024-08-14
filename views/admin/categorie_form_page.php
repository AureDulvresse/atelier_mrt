<?php


include 'includes/sidebar.php';
?>
<div class="main-content">
    <header class="header">
        <h3>Gestion des Œuvres</h3>
    </header>

    <!-- Formulaire pour ajouter/modifier une œuvre -->
    <div class="form-container">
        <form action="add_category.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la catégorie</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <div class="table-container">
        <div class="table-card">
            <div class="table-header">
                <h5>Œuvres</h5>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Medium</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artworks as $artwork) : ?>
                        <tr>
                            <td class="table-img">
                                <img src="/atelier_mrt/<?php echo ($artwork->thumbnail != null) ? htmlspecialchars($artwork->thumbnail) : "assets/images/sample.jpg"; ?>" alt="<?php echo htmlspecialchars($artwork->title); ?>" width="100">
                            </td>
                            <td><?php echo htmlspecialchars($artwork->title); ?></td>
                            <td><?php echo htmlspecialchars($artwork->description); ?></td>
                            <td><?php echo htmlspecialchars($artwork->price); ?></td>
                            <td><?php echo htmlspecialchars($artwork->category_name); ?></td>
                            <td><?php echo htmlspecialchars($artwork->medium_name); ?></td>
                            <td>
                                <button onclick="editArtwork(<?php echo htmlspecialchars(json_encode($artwork)); ?>)"><i class="bx bx-pencil"></i></button>
                                <button onclick="deleteArtwork(<?php echo $artwork->id; ?>)"><i class="bx bx-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    