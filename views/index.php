<?php include './views/includes/header.php'; ?>

<!-- Section de présentation -->
<section id="home" class="hero flex flex-column justify-center align-start">
    <div class="hero-content">
        <h1 class="hero-title">Bienvenue à l'Atelier MRT</h1>
        <p class="hero-description">Explorez notre collection d'art unique et découvrez des œuvres qui inspirent.</p>
        <a href="#gallery" class="btn-primary">Voir la Galerie</a>
    </div>
</section>


<!-- Section À Propos -->
<section id="about" class="about flex flex-column align-center">
    <div class="container">
        <h2>À Propos de Nous</h2>
        <p>Notre atelier est dédié à la création et à la présentation d'art unique. Nous croyons en la puissance de l'art pour transformer les espaces et les esprits.</p>
        <a href="about.php" class="btn-secondary">En savoir plus</a>
    </div>
</section>

<!-- Section Galerie -->
<section id="gallery" class="gallery flex flex-column align-center">
    <div class="container">
        <h2>Galerie</h2>
        <div class="gallery-grid flex flex-wrap mb-3">
            <?php for ($i = 0; $i < 6; $i++) { ?>
                <div class="gallery-item flex flex-column">
                    <img src="assets/images/sample.jpg" alt="Œuvre d'art">
                    <div class="gallery-info">
                        <h3>Titre de l'œuvre</h3>
                        <p>Description brève.</p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <a href="gallery.php" class="btn-secondary">Voir plus d'œuvres</a>
    </div>
</section>

<!-- Section Contact -->
<section id="contact" class="contact flex flex-column align-center">
    <div class="container">
        <h2>Contactez-nous</h2>
        <p>Vous avez des questions ? N'hésitez pas à nous contacter pour plus d'informations.</p>
        <a href="contact.php" class="btn-primary">Nous Contacter</a>
    </div>
</section>

<!-- Section Boutique -->
<section id="shop" class="shop flex flex-column align-center">
    <div class="container">
        <h2>Boutique</h2>
        <p>Découvrez nos œuvres disponibles à l'achat et apportez une touche artistique à votre espace.</p>
        <a href="./shop/index.php" class="btn-primary">Voir la Boutique</a>
    </div>
</section>


<?php include './views/includes/footer.php'; ?>