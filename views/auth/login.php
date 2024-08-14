<?php

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
                <form action="/atelier_mrt/auth/traitement/login" method="post">

                    <?php if (isset($message) && !empty($message)) : ?>
                        <div class="alert error fade-out">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['login_message']) && !empty($_SESSION['login_message'])) : ?>
                        <div class="alert success fade-out">
                            <?php echo htmlspecialchars($_SESSION['login_message']); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Affichage du token CSRF -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">

                    <div class="row">
                        <input type="email" name="email" class="form-input" placeholder="Entrer votre adresse mail" required />
                    </div>

                    <div class="row">
                        <input type="password" name="password" class="form-input" placeholder="Entrer votre mot de passe" required />
                    </div>
                    <div class="row">
                        <button type="submit" class="btn black">Envoyer</button>
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