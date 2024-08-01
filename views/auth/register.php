<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "Pour une meilleure expérience";

$csrfToken = "Token";

include './views/includes/breadcrumb.php';

?>


<section class="section-body">
    <div class="container">
        <div class="form-container">
            <div class="form-box">
                <h3 class="title">Inscription</h3>
                <form action="path/to/your/login/handler.php" method="post">

                    <!-- ffichage du token CSRF (à générer et à inclure selon votre méthode de gestion CSRF) -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

                    <div class="row">
                        <input type="text" class="form-input" name="first_name" placeholder="Entrer votre prenom" />
                        <input type="text" class="form-input" name="last_name" placeholder="Entrer votre nom" />
                    </div>

                    <div class="row">
                        <input type="email" class="form-input" name="email" placeholder="Entrer votre adresse mail" />
                    </div>


                    <div class="row">
                        <input type="password" class="form-input" name="pwd" placeholder="Entrer un mot de passe" />
                    </div>

                    <div class="row">
                        <input type="password" class="form-input" name="pwd" placeholder="Confirmer le mot de passe" />
                    </div>

                    <div class="row">
                        <button type="submit" class="btn">Envoyer</button>
                    </div>

                </form>
                <div class="row">
                    <p>J'ai déjà un compte ?</p>
                    <a href="login"> Me Connecter </a>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include './views/includes/footer.php'; ?>