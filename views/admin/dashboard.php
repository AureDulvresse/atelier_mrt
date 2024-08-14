<?php

use App\Models\Artwork;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Post;

$artworks = Artwork::all($pdo);
$orders = Order::all($pdo);

// Compter les éléments
$artworkCount = Artwork::count($pdo);
$orderCount = Order::count($pdo);
$customerCount = Customer::count($pdo);
// $eventCount = Post::countEvents($pdo);
$eventCount = 0;

include 'includes/sidebar.php';
?>

<div class="main-content">
    <header class="header">
        <h3>Tableau de Bord</h3>
    </header>
    <div class="stats-grid">
        <div class="stat-box">
            <p class="stat-value"><?php echo htmlspecialchars($artworkCount); ?></p>
            <span class="stat-label">Œuvres</span>
        </div>
        <div class="stat-box">
            <p class="stat-value"><?php echo htmlspecialchars($orderCount); ?></p>
            <span class="stat-label">Commandes</span>
        </div>
        <div class="stat-box">
            <p class="stat-value"><?php echo htmlspecialchars($customerCount); ?></p>
            <span class="stat-label">Clients</span>
        </div>
        <div class="stat-box">
            <p class="stat-value"><?php echo htmlspecialchars($eventCount); ?></p>
            <span class="stat-label">Événements</span>
        </div>
    </div>
        <?php if (isset($artworks) && !empty($artworks)) { ?>
    <div class="tables-container">
        <div class="table-card">
            <div class="table-header">
                <h5>Œuvres</h5>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artworks as $artwork) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($artwork->title); ?></td>
                            <td><?php echo htmlspecialchars($artwork->description); ?></td>
                            <td><?php echo htmlspecialchars($artwork->price); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
        <div class="table-card">
            <div class="table-header">
                <h5>Commandes</h5>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Client</th>
                        <th>Date de commande</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['artwork_title']); ?></td>
                            <td><?php echo htmlspecialchars($order['customer_first_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['ordered_at']); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>

</html>