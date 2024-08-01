<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require './controllers/AuthController.php'; // Inclure le contrôleur d'authentification

// Initialiser le contrôleur d'authentification
$authController = new AuthController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
    $csrfToken = $_POST['csrf_token']; // Récupération du token CSRF

    // Vérification du token CSRF
    if ($csrfToken !== $_SESSION['csrf_token']) {
        $message = 'Token CSRF invalide.';
    } else {
        $loginResult = $authController->login($email, $password);

        if ($loginResult['error']) {
            $message = $loginResult['message'];
        } else {
            $message = $loginResult['message'];
            // Redirection ou gestion après connexion réussie
            header('Location: /');
            exit;
        }
    }
}

// Génération d'un token CSRF
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

$msg = "Pour une meilleure expérience";
$csrfToken = $_SESSION['csrf_token'];

include './views/includes/breadcrumb.php';

?>

<section class="section-body">
    <div class="container">
        <div class="form-container">
            <div class="form-box">
                <h3 class="title">Connexion</h3>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <!-- Affichage du token CSRF -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

                    <div class="row">
                        <input type="email" name="email" class="form-input" placeholder="Entrer votre adresse mail" required />
                    </div>

                    <div class="row">
                        <input type="password" name="password" class="form-input" placeholder="Entrer votre mot de passe" required />
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