<?php

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
                <form action="/atelier_mrt/auth/traitement/register" method="post">

                    <?php if (isset($message) && !empty($message)) : ?>
                        <div class="alert error fade-out">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['message_register']) && !empty($_SESSION['message_register'])) : ?>
                        <div class="alert success fade-out">
                            <?php echo htmlspecialchars($_SESSION['message_register']); ?>
                        </div>
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