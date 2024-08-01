<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = $auth->login($email, $password);

    if ($login['error']) {
        echo $login['message'];
    } else {
        echo 'Connexion réussie. Bienvenue!';
    }
}


$msg = "Pour une meilleure expérience";

$csrfToken = "Token";

include './views/includes/breadcrumb.php';

?>


<section class="section-body">
    <div class="container">
        <div class="form-container">
            <div class="form-box">
                <h3 class="title">Connexion</h3>
                <form action="path/to/your/login/handler.php" method="post">

                    <!-- ffichage du token CSRF (à générer et à inclure selon votre méthode de gestion CSRF) -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

                    <div class="row">
                        <input type="email" class="form-input" placeholder="Entrer votre adresse mail" />
                    </div>

                    <div class="row">
                        <input type="password" class="form-input" placeholder="Entrer votre mot de passe" />
                    </div>
                    <div class="row">
                        <button type="submit" class="btn">Envoyer</button>
                    </div>
                    <a href="forgot-password"> Mot de passe oublié? </a>

                </form>
                <div class="row">
                    <p>Vous n'avez pas de compte ?</p>
                    <a href="register"> Créer un compte </a>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include './views/includes/footer.php'; ?>