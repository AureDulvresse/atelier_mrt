<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "Cette oeuvre vous plait";

// echo $_GET['id'];


include './views/includes/breadcrumb.php';
?>
<section class="section gallery">
    <div class="container">
        <div class="grid">
            <div class="">
                <img src="/assets/images/sample.jpg" alt="" />
            </div>
            <div class="detail">
                <h1 class="title">Artwork titre</h1>
            </div>
        </div>
    </div>
</section>
<?php include './views/includes/footer.php'; ?>