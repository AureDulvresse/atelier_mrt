<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "Pour une meilleure expérience";


include './views/includes/breadcrumb.php';
?>


<section class="contact">
    <div class="container">
        <div class="contact-box">
            <form action="path/to/your/login/handler.php" method="post">
            <?php
        // Affichage du token CSRF (à générer et à inclure selon votre méthode de gestion CSRF)
        echo '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($csrfToken) . '">';
        ?>
                <div class="row">
                    <input type="email" class="form-input" placeholder="addresse mail" />
                </div>

                <div class="row">
                    <input type="password" class="form-input" placeholder="Mot de passe" />
                </div>
                <button type="submit" class="btn">Envoyer</>
            </form>
            <a href="path/to/forgot-password.php" class="text-sm text-gray-600"> Mot de passe oublié? </a>
        <a href="path/to/register.php" class="text-sm text-gray-600"> Créer un compte </a>
        </div>
    </div>
</section>


<?php include './views/includes/footer.php'; ?>
