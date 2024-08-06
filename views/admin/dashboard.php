<?php

use App\Models\Artwork;
use App\Models\Order;

$artworks = Artwork::all($pdo);
$orders = Order::all($pdo);

include 'includes/sidebar.php';
?>

<div class="main-content">
    <header class="header">
        <h3>Tableau de Bord</h3>
    </header>
    <div class="stats-grid">
        <div class="stat-box">
            <p class="stat-value">55</p>
            <span class="stat-label">Occupants du Bâtiment</span>
        </div>
        <div class="stat-box">
            <p class="stat-value">150</p>
            <span class="stat-label">Visiteurs de ce Mois</span>
        </div>
        <div class="stat-box">
            <p class="stat-value">15</p>
            <span class="stat-label">Moyenne Quotidienne de Visiteurs</span>
        </div>
        <div class="stat-box">
            <p class="stat-value">250</p>
            <span class="stat-label">Visiteurs du Mois Dernier</span>
        </div>
    </div>
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
                            <td><?php echo htmlspecialchars($order['customer_id']); ?></td>
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