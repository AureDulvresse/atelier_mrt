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

   
    