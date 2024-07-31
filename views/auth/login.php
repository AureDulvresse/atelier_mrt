<?php
$title = "Connexion";
include 'base.php'; // Inclure le fichier de base qui pourrait contenir des en-têtes et autres inclusions globales
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="path/to/your/css/file.css"> <!-- Inclure le fichier CSS -->
    <!-- Ajouter les autres inclusions nécessaires -->
</head>
<body>

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Connexion</li>
        <li class="breadcrumb-item">Pour une meilleure expérience</li>
    </ol>
</nav>

<section
  class="mt-8 pt-4 pb-5 contact wow animate__animated animate__fadeIn"
  data-wow-delay="0.3s"
>
  <div class="container mx-auto flex items-center justify-center">
    <div
      class="auth-form wow animate__animated animate__slideInUp shadow rounded-sm px-4 py-3"
    >
      <form action="path/to/your/login/handler.php" method="post" id="login-form">
        <h2 class="text-4xl text-black text-center">Connexion</h2>

        <?php
        // Affichage du token CSRF (à générer et à inclure selon votre méthode de gestion CSRF)
        echo '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($csrfToken) . '">';
        ?>

        <?php
        // Affichage du formulaire, à remplacer par la logique PHP appropriée
        echo $form;
        ?>

        <button type="submit" class="btn btn-black mt-3 w-full">Se connecter</button>
      </form>
      <div class="mt-3 mb-4 flex justify-center items-center gap-3 text-center">
        <a href="path/to/forgot-password.php" class="text-sm text-gray-600"> Mot de passe oublié? </a>
        <a href="path/to/register.php" class="text-sm text-gray-600"> Créer un compte </a>
      </div>
    </div>
  </div>
</section>

</body>
</html>
