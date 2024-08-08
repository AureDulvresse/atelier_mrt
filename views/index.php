<?php

use App\Models\Artwork;

$artworks = Artwork::all($pdo);

include './views/includes/header.php'; ?>

<!-- Section de présentation -->
<div class="header-content">
    <div class="caption-bg"></div>
    <div class="container grid-2">
        <div class="column-1">
            <h1 class="header-title">Bienvenue sur <span>l'atelier MRT</span></h1>
            <p class="text">
                Explorez notre collection d'art et trouvez l'inspiration !
            </p>
            <a href="#gallery" class="btn" data-aos="fade-up" data-aos-duration="1000">Découvrir mes tableaux</a>
        </div>
    </div>
</div>
</header>

<!-- Section À Propos -->
<section class="about section" id="about">
    <div class="container">
        <div class="section-header">
            <h3 class="title" data-title="Qui suis-je ?">À Propos</h3>
        </div>

        <div class="section-body grid-2">
            <div class="column-1" data-aos="fade-right" data-aos-duration="1200">
                <h3 class="title-sm">Salut, je suis</h3>
                <p class="text">
                    Peintre français né en 1983 d'origine Espagnole, entouré depuis son plus jeune âge par une famille d'artistes. Il s'inspire de leurs différentes techniques et de leurs différents styles pour créer son propre univers. Pour lui, la peinture est un moyen d'expression, de transmission, de création et de contemplation. Chacune de ses œuvres est une explosion de couleurs, de formes et d'énergie, créant un langage visuel unique qui brise les frontières de la tradition artistique. À travers ses personnages, il aime mélanger les styles et les époques : "une véritable rencontre entre Cubisme, Street-art et Pop-art". Un mariage inattendu mais époustouflant de styles.
                </p>
            </div>

            <div class="column-2 image" data-aos="fade-left" data-aos-duration="2000">
                <img src="./assets/images/shapes/points4.png" class="points" alt="" />
                <img src="./assets/images/logo.png" class="z-index" alt="" />
            </div>
        </div>
    </div>
</section>

<!-- Section Galerie -->
<section class="gallery section" id="gallery">
    <div class="background-bg">
        <div class="overlay overlay-sm">
            <!-- Images de fond -->
            <img src="./assets/images/shapes/half-circle.png" class="shape half-circle1" alt="" data-aos="fade-up" data-aos-duration="1000" />
            <img src="./assets/images/shapes/half-circle.png" class="shape half-circle2" alt="" data-aos="fade-up" data-aos-duration="2000" />
            <img src="./assets/images/shapes/square.png" class="shape square" alt="" data-aos="fade-up" data-aos-duration="3000" />
            <img src="./assets/images/shapes/wave.png" class="shape wave" alt="" data-aos="fade-up" data-aos-duration="4000" />
            <img src="./assets/images/shapes/circle.png" class="shape circle" alt="" data-aos="fade-up" data-aos-duration="5000" />
            <img src="./assets/images/shapes/triangle.png" class="shape triangle" alt="" data-aos="fade-up" data-aos-duration="6000" />
            <img src="./assets/images/shapes/x.png" class="shape xshape" alt="" data-aos="fade-up" data-aos-duration="7000" />
        </div>
    </div>

    <div class="container">
        <div class="section-header">
            <h3 class="title" data-title="Découvrir ma galerie">Mes Œuvres</h3>
        </div>

        <div class="section-body">
            <div class="filter">
                <button class="filter-btn active" data-filter="*">Toutes</button>
                <button class="filter-btn" data-filter=".peinture">Peinture</button>
                <button class="filter-btn" data-filter=".dessin">Dessin</button>
                <button class="filter-btn" data-filter=".sculpture">Sculpture</button>
                <button class="filter-btn" data-filter=".photographie">Photographie</button>
            </div>

            <div class="grid" data-aos="fade-up" data-aos-duration="11000">
                <?php foreach ($artworks as $artwork) : ?>
                    <div class="grid-item peinture">
                        <div class="gallery-image">
                            <img src="<?php echo ($artwork->thumbnail != null) ? htmlspecialchars($artwork->thumbnail) : "/atelier_mrt/assets/images/sample.jpg"; ?>" alt="<?php echo htmlspecialchars($artwork->title); ?>" />
                            <div class="img-overlay">
                                <div class="img-overlay-content">
                                    <div class="img-description">
                                        <h3><?php echo htmlspecialchars($artwork->title); ?></h3>
                                        <h5><?php echo htmlspecialchars($artwork->category_name); ?></h5>
                                    </div>
                                    <a href="shop/artwork/<?php echo htmlspecialchars($artwork->id); ?>" class="btn black small">Détail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="more-btn">
                <a href="shop" class="btn">Explorer la galerie</a>
            </div>
        </div>
    </div>
</section>

<!-- Section Records
<section class="records">
    <div class="overlay overlay-sm">
        <img src="./assets/images/shapes/square.png" alt="" class="shape square1" />
        <img src="./assets/images/shapes/square.png" alt="" class="shape square2" />
        <img src="./assets/images/shapes/circle.png" alt="" class="shape circle" />
        <img src="./assets/images/shapes/half-circle.png" alt="" class="shape half-circle" />
        <img src="./assets/images/shapes/wave.png" alt="" class="shape wave wave1" />
        <img src="./assets/images/shapes/wave.png" alt="" class="shape wave wave2" />
        <img src="./assets/images/shapes/x.png" alt="" class="shape xshape" />
        <img src="./assets/images/shapes/triangle.png" alt="" class="shape triangle" />
    </div>

    <div class="container">
        <div class="wrap">
            <div class="record-circle">
                <h2 class="number" data-num="235">0</h2>
                <h4 class="sub-title">Projets</h4>
            </div>
        </div>

        <div class="wrap">
            <div class="record-circle active">
                <h2 class="number" data-num="174">0</h2>
                <h4 class="sub-title">Clients Satisfaits</h4>
            </div>
        </div>

        <div class="wrap">
            <div class="record-circle">
                <h2 class="number" data-num="892">0</h2>
                <h4 class="sub-title">Heures de Travail</h4>
            </div>
        </div>

        <div class="wrap">
            <div class="record-circle">
                <h2 class="number" data-num="368">0</h2>
                <h4 class="sub-title">Récompenses</h4>
            </div>
        </div>
    </div>
</section> -->

<!-- Section Blog -->
<section class="blog section" id="blog">
    <div class="container">
        <div class="section-header">
            <h3 class="title" data-title="Dernières Nouvelles">Mon Blog</h3>
            <p class="text">
                Découvrez les dernières actualités et exposition de l'atelier MRT.
            </p>
        </div>

        <div class="blog-wrapper">
            <?php for ($i = 0; $i < 3; $i++) : ?>
                <div class="blog-wrap">
                    <img src="" alt="" class="points points-sq" />

                    <div class="blog-card">
                        <div class="blog-image">
                            <img src="./assets/images/sample.jpg" alt="" />
                        </div>

                        <div class="blog-content">
                            <div class="blog-info">
                                <h5 class="blog-date">19 Mars, 2020</h5>
                            </div>
                            <h3 class="title-sm">Un Titre Court</h3>
                            <p class="blog-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem poimus? Tempora expedita eos autem!
                            </p>
                            <a href="blog/post/<?php echo $i + 1; ?>" class="btn small">Lire la Suite</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="more-btn">
            <a href="blog" class="btn">Voir plus</a>
        </div>
    </div>
</section>

<!-- Section Contact -->
<section class="contact" id="contact">
    <div class="container">
        <div class="contact-box">
            <div class="contact-info">
                <h3 class="title" data-title="Parlons-en">Contactez-moi</h3>
                <p class="text">
                    Une question, une commande, une demande spécifique ? N'hésitez pas à me contacter, je vous répondrai dans les plus brefs délais.
                </p>
                <div class="information-wrap">
                    <div class="information">
                        <i class="bx bxs-map"></i>
                        <p class="info-text">Boulevard, Paris, France</p>
                    </div>
                    <div class="information">
                        <i class="bx bxs-phone"></i>
                        <p class="info-text">+33 123 456 789</p>
                    </div>
                    <div class="information">
                        <i class="bx bxs-envelope"></i>
                        <p class="info-text">mtr.artiste@gmail.com</p>
                    </div>
                </div>
                <div class="contact-social">
                    <a href="#"><i class="bx bxl-instagram-alt"></i></a>
                    <a href="#"><i class="bx bxl-twitter"></i></a>
                    <a href="#"><i class="bx bxl-dribbble"></i></a>
                </div>
            </div>
            <div class="contact-form">
                <div class="row">
                    <input type="text" class="form-input" name="first_name" id="first_name" placeholder="Prénom" />
                    <input type="text" class="form-input" name="last_name" id="last_name" placeholder="Nom" />
                </div>

                <div class="row">
                    <input type="email" class="form-input" name="email" id="email" placeholder="Email" />
                </div>

                <div class="row">
                    <textarea name="message" class="form-input textarea" name="message" id="message" placeholder="Message"></textarea>
                </div>
                <button class="btn" id="send-mail">Envoyer</button>
            </div>
        </div>
    </div>
</section>

<section class="map-section">
    <h2 class="title">Retrouvez mon atelier</h2>
    <!-- google map section -->
    <div class="w-100">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.0420661135564!2d2.2922926156748405!3d48.85884407928767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671d83d7c8bbf%3A0x8c8e13d2b0c7d9!2sEiffel+Tower%2C+Champ+de+Mars%2C+75007+Paris%2C+France!5e0!3m2!1sen!2sbd!4v1589262060663!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" title="Address" style="border: 0" allowfullscreen="" class="embed-responsive-item"></iframe>
    </div>
    <!-- end google map section -->
</section>

<?php include './views/includes/footer.php'; ?>