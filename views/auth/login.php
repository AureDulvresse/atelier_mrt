<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "DPour une meilleure expérience";


include './views/includes/breadcrumb.php';
?>


<section class="contact">
    <div class="container">
        <div class="contact-box">
            <form method="post">
                <div class="row">
                    <input type="email" class="form-input" placeholder="addresse mail" />
                </div>

                <div class="row">
                    <input type="password" class="form-input" placeholder="Mot de passe" />
                </div>
                <button type="submit" class="btn">Envoyer</>
            </form>
        </div>
    </div>
</section>


<?php include './views/includes/footer.php'; ?>