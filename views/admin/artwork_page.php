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
        <form action="artwork_action.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="artwork_id">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>
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
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="form-group">
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- Tableau des œuvres -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Medium</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artworks as $artwork) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($artwork->title); ?></td>
                        <td><?php echo htmlspecialchars($artwork->description); ?></td>
                        <td><?php echo htmlspecialchars($artwork->price); ?></td>
                        <td><?php echo htmlspecialchars($artwork->category_name); ?></td>
                        <td><?php echo htmlspecialchars($artwork->medium_name); ?></td>
                        <td><img src="uploads/<?php echo htmlspecialchars($artwork->thumbnail); ?>" alt="<?php echo htmlspecialchars($artwork->title); ?>" width="100"></td>
                        <td>
                            <button onclick="editArtwork(<?php echo htmlspecialchars(json_encode($artwork)); ?>)" class="btn black">Modifier</button>
                            <button onclick="deleteArtwork(<?php echo $artwork->id; ?>)" class="btn">Supprimer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function editArtwork(artwork) {
        document.getElementById('artwork_id').value = artwork.id;
        document.getElementById('title').value = artwork.title;
        document.getElementById('description').value = artwork.description;
        document.getElementById('price').value = artwork.price;
        document.getElementById('category').value = artwork.category_id;
        document.getElementById('medium').value = artwork.medium_id;
    }

    function deleteArtwork(id) {
        if (confirm('Voulez-vous vraiment supprimer cette œuvre ?')) {
            window.location.href = 'delete_artwork.php?id=' + id;
        }
    }
</script>
</main>
</body>

</html>