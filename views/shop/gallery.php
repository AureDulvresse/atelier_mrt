<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "Découvrer ma galerie";

// Initialiser les variables de recherche et de filtre
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$filterCategory = isset($_GET['category']) ? $_GET['category'] : '';
$itemsPerPage = 12; // Nombre d'éléments par page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Préparer la requête SQL pour la recherche et le filtrage
$sql = "SELECT * FROM artworks WHERE 1=1";
if ($searchTerm) {
    $sql .= " AND title LIKE :searchTerm";
}
if ($filterCategory) {
    $sql .= " AND category = :filterCategory";
}
$sql .= " LIMIT :offset, :itemsPerPage";

// Préparer la requête SQL pour le nombre total d'éléments
$sqlCount = "SELECT COUNT(*) FROM artworks WHERE 1=1";
if ($searchTerm) {
    $sqlCount .= " AND title LIKE :searchTerm";
}
if ($filterCategory) {
    $sqlCount .= " AND category = :filterCategory";
}

// Exécuter la requête pour obtenir les œuvres
$stmt = $pdo->prepare($sql);
if ($searchTerm) {
    $stmt->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
}
if ($filterCategory) {
    $stmt->bindValue(':filterCategory', $filterCategory, PDO::PARAM_STR);
}
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
$stmt->execute();
$artworks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Exécuter la requête pour obtenir le nombre total d'œuvres
$stmtCount = $pdo->prepare($sqlCount);
if ($searchTerm) {
    $stmtCount->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
}
if ($filterCategory) {
    $stmtCount->bindValue(':filterCategory', $filterCategory, PDO::PARAM_STR);
}
$stmtCount->execute();
$totalItems = $stmtCount->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

include './views/includes/breadcrumb.php';
?>

<!-- Section de la galerie -->
<section class="gallery section">
    <div class="container">
        <!-- Formulaire de recherche et filtres -->
        <div class="filter-container">
            <form method="get" action="">
                <input type="text" name="search" placeholder="Recherche..." value="<?php echo htmlspecialchars($searchTerm); ?>" />
                <select name="category">
                    <option value="">Toutes les catégories</option>
                    <option value="peinture" <?php if ($filterCategory === 'peinture') echo 'selected'; ?>>Peinture</option>
                    <option value="dessin" <?php if ($filterCategory === 'dessin') echo 'selected'; ?>>Dessin</option>
                    <option value="sculpture" <?php if ($filterCategory === 'sculpture') echo 'selected'; ?>>Sculpture</option>
                    <option value="photographie" <?php if ($filterCategory === 'photographie') echo 'selected'; ?>>Photographie</option>
                </select>
                <button type="submit" class="btn">Rechercher</button>
            </form>
        </div>

        <!-- Affichage des œuvres -->
        <div class="grid">
            <?php if ($artworks) : ?>
                <?php foreach ($artworks as $artwork) : ?>
                    <div class="grid-item <?php echo htmlspecialchars($artwork['category']); ?>">
                        <div class="gallery-image">
                            <img src="../assets/images/<?php echo htmlspecialchars($artwork['image']); ?>" alt="<?php echo htmlspecialchars($artwork['title']); ?>" />
                            <div class="img-overlay">
                                <div class="img-overlay-content">
                                    <div class="img-description">
                                        <h3><?php echo htmlspecialchars($artwork['title']); ?></h3>
                                        <p><?php echo htmlspecialchars($artwork['description']); ?></p>
                                    </div>
                                    <button class="btn" title="Ajouter au panier">
                                        <i class="bx bx-cart-add bx-sm small"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune œuvre trouvée.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($currentPage > 1) : ?>
                <a href="?search=<?php echo urlencode($searchTerm); ?>&category=<?php echo urlencode($filterCategory); ?>&page=<?php echo $currentPage - 1; ?>" class="btn">Précédent</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a href="?search=<?php echo urlencode($searchTerm); ?>&category=<?php echo urlencode($filterCategory); ?>&page=<?php echo $i; ?>" class="btn <?php if ($i === $currentPage) echo 'active'; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages) : ?>
                <a href="?search=<?php echo urlencode($searchTerm); ?>&category=<?php echo urlencode($filterCategory); ?>&page=<?php echo $currentPage + 1; ?>" class="btn">Suivant</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>