<?php

use App\Models\Artwork;
use App\Models\Medium;

$artworks = Artwork::all($pdo);
$mediums = Medium::all($pdo);

include 'includes/sidebar.php';
?>
<div class="main-content">
    <header class="header">
        <h3>Gestion des Œuvres</h3>
    </header>

    <!-- Formulaire pour ajouter/modifier une œuvre -->
    <div class="form-container">
        <form action="actions/artworks" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="artwork_id">
            <input type="hidden" name="action" id="action" value="add">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Prix</label>
                <input type="text" name="price" id="price" required>
            </div>
            <div class="form-group">
                <label for="medium">Medium</label>
                <select name="medium_id" id="medium" required>
                    <?php foreach ($mediums as $medium) : ?>
                        <option value="<?php echo $medium->id; ?>"><?php echo $medium->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label for="height">Hauteur</label>
                    <input type="number" name="height" id="height" required>
                </div>
                <div class="form-group">
                    <label for="width">Largeur</label>
                    <input type="number" name="width" id="width" required>
                </div>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- Tableau des œuvres -->
    <?php if (isset($artworks) && !empty($artworks)) { ?>
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
                                    <img src="/<?php echo ($artwork->thumbnail != null) ? htmlspecialchars($artwork->thumbnail) : "assets/images/sample.jpg"; ?>" alt="<?php echo htmlspecialchars($artwork->title); ?>" width="100">
                                </td>
                                <td><?php echo htmlspecialchars($artwork->title); ?></td>
                                <td><?php echo htmlspecialchars($artwork->description); ?></td>
                                <td><?php echo htmlspecialchars($artwork->price); ?></td>
                                <td><?php echo htmlspecialchars($artwork->stock); ?></td>
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
    <?php } ?>
</div>

<script>
    function editArtwork(artwork) {
        document.getElementById('artwork_id').value = artwork.id;
        document.getElementById('title').value = artwork.title;
        document.getElementById('description').value = artwork.description;
        document.getElementById('price').value = artwork.price;
        document.getElementById('width').value = artwork.width;
        document.getElementById('height').value = artwork.height;
        document.getElementById('stock').value = artwork.stock;
        document.getElementById('medium').value = artwork.medium_id;

        // Changer l'action en 'edit'
        document.getElementById('action').value = 'edit';
    }

    function deleteArtwork(id) {
        if (confirm('Voulez-vous vraiment supprimer cette œuvre ?')) {
            // Rediriger vers l'action de suppression avec la méthode POST
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'actions/artworks.php';

            const idField = document.createElement('input');
            idField.type = 'hidden';
            idField.name = 'id';
            idField.value = id;

            const actionField = document.createElement('input');
            actionField.type = 'hidden';
            actionField.name = 'action';
            actionField.value = 'delete';

            form.appendChild(idField);
            form.appendChild(actionField);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
</div>

</body>

</html>