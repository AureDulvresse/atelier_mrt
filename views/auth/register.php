<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require './controllers/AuthController.php';

// Initialiser le contrôleur d'authentification
$authController = new AuthController($pdo);

// Initialisation du message d'erreur ou de succès
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $repeatPassword = $_POST['repeat_pwd'];
    $csrfToken = $_POST['csrf_token']; // Récupération du token CSRF

    // Vérification du token CSRF
    if ($csrfToken !== $_SESSION['csrf_token']) {
        $message = 'Token CSRF invalide.';
    } else {
        // Appel au contrôleur pour l'inscription
        $authController->register($firstName, $lastName, $email, $password, $repeatPassword);
        $message = $authController->registerMessage(); // Récupérer le message après inscription
    }
}

// Génération d'un token CSRF
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$csrfToken = $_SESSION['csrf_token'];
$msg = "Vous êtes nouveau ? Rejoignez-nous !";

include './views/includes/breadcrumb.php';

?>

<section class="section-body">
    <div class="container">
        <div class="form-container">
            <div class="form-box">
                <h3 class="title">Inscription</h3>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                    <?php if ($message) : ?>
                        <div class="message"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>

                    <!-- Affichage du token CSRF -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

                    <div class="row">
                        <input type="text" class="form-input" name="first_name" placeholder="Entrer votre prénom" required />
                        <input type="text" class="form-input" name="last_name" placeholder="Entrer votre nom" required />
                    </div>

                    <div class="row">
                        <input type="email" class="form-input" name="email" placeholder="Entrer votre adresse mail" required />
                    </div>

                    <div class="row">
                        <input type="password" class="form-input" name="pwd" placeholder="Entrer un mot de passe" required />
                    </div>

                    <div class="row">
                        <input type="password" class="form-input" name="repeat_pwd" placeholder="Confirmer le mot de passe" required />
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