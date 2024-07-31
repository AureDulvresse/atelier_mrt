<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "Vous avez oublié votre mot de passe ?";

$csrfToken = "Token";

include './views/includes/breadcrumb.php';

?>


<section class="section-body">
    <div class="container">
        <div class="form-container">
            <div class="form-box">
                <h3 class="title">Adresse mail</h3>
                <form action="path/to/your/login/handler.php" method="post">

                    <!-- ffichage du token CSRF (à générer et à inclure selon votre méthode de gestion CSRF) -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">


                    <div class="row">
                        <input type="email" class="form-input" name="email" placeholder="Entrer votre addresse mail" />
                    </div>

                    <div class="row">
                        <button type="submit" class="btn">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php include './views/includes/footer.php'; ?>