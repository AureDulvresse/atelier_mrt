<?php

use App\Models\Artwork;
use App\Models\Category;
use App\Models\Medium;

$artworks = Artwork::all($pdo);
$categories = Category::all($pdo);
$mediums = Medium::all($pdo);

include 'includes/sidebar.php';
?>
<div class="main-content">
    <header class="header">
        <h3>Gestion des Œuvres</h3>
    </header>

    <!-- Formulaire pour ajouter/modifier une œuvre -->
    <div class="form-container">
        <form action="artworks/actions" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="artwork_id">
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
                <label for="category">Catégorie</label>
                <select name="category_id" id="category" required>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="medium">Medium</label>
                <select name="medium_id" id="medium" required>
                    <?php foreach ($mediums as $medium) : ?>
                        <option value="<?php echo $medium['id']; ?>"><?php echo $medium['name']; ?></option>
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
        document.getElementById('category').value = artwork.category_id;
        document.getElementById('medium').value = artwork.medium_id;
    }

    function deleteArtwork(id) {
        if (confirm('Voulez-vous vraiment supprimer cette œuvre ?')) {
            window.location.href = `artworks/actions/${id}/delete`;
        }
    }
</script>

</main>
</body>

</html>