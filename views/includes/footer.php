<footer class="footer">
    <div class="container">
        <div class="grid-3">
            <div class="grid-3-col footer-about">
                <h3 class="title-sm">Atelier <span>MrT</span></h3>
                <p class="text">
                    Découvrez une collection exceptionnelle d'œuvres d'art contemporaine
                </p>
            </div>

            <div class="grid-3-col footer-links">
                <h3 class="title-sm">Liens Rapide</h3>
                <ul>
                    <li>
                        <a href="#header">Accueil</a>
                    </li>
                    <li>
                        <a href="#gallery">Galerie</a>
                    </li>
                    <li>
                        <a href="#about">A Propos</a>
                    </li>
                    <li>
                        <a href="#blog">Actualité & évènements</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="grid-3-col footer-links">
                <h3 class="title-sm">Contact</h3>
                <ul>
                    <li>
                        <a href="#">Web Design</a>
                    </li>
                    <li>
                        <a href="#">Web Dev</a>
                    </li>
                    <li>
                        <a href="#">App Design</a>
                    </li>
                    <li>
                        <a href="#">Marketing</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="bottom-footer">
            <div class="copyright">
                <p class="text">
                    Copyright&copy;2024 Atelier MrT
                </p>
            </div>
        </div>
    </div>
    <div class="back-btn-wrap">
        <a href="#header" class="back-btn">
            <i class="bx bx-chevron-up"></i>
        </a>
    </div>
</footer>

</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php includeJS('isotope.pkgd.min.js'); ?>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<?php includeJS('scripts.js'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $config['paypal']['client_id']; ?>&currency=USD"></script>
</body>

</html>