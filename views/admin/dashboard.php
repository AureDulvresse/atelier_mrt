<?php

include 'includes/sidebar.php';
?>

<div class="main-content flex-grow-1 p-4">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <h3>Tableau de Bord</h3>
    </header>
    <div class="grid grid-4">
        <div class="col-md-3">
            <div class="stat-box p-3 bg-light rounded h-100 d-flex flex-column justify-content-center">
                <p class="display-6">55</p>
                <span>Occupants du Bâtiment</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box p-3 bg-light rounded h-100 d-flex flex-column justify-content-center">
                <p class="display-6">150</p>
                <span>Visiteurs de ce Mois</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box p-3 bg-light rounded h-100 d-flex flex-column justify-content-center">
                <p class="display-6">15</p>
                <span>Moyenne Quotidienne de Visiteurs</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box p-3 bg-light rounded h-100 d-flex flex-column justify-content-center">
                <p class="display-6">250</p>
                <span>Visiteurs du Mois Dernier</span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 visitor-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php foreach ($artworks as $artwork) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($artwork['title']); ?></td>
                                    <td><?php echo htmlspecialchars($artwork['description']); ?></td>
                                    <td><?php echo htmlspecialchars($artwork['price']); ?></td>
                                </tr>
                                <?php endforeach; ?> -->
                        <!-- Ajoutez plus de lignes de visiteurs ici -->
                    </tbody>
                </table>
            </div>
            <div class="col-6 visitor-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Client</th>
                            <th>Date de commande</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($order['artwork_title']); ?></td>
                                    <td><?php echo htmlspecialchars($order['customer_id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['ordered_at']); ?></td>
                                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                </tr>
                                <?php endforeach; ?> -->
                        <!-- Ajoutez plus de lignes de visiteurs ici -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
</body>

</html>