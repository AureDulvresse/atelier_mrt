<?php

use App\Controllers\AuthController;

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
        // Appel à la méthode login qui retourne un objet Response
        $loginResult = $authController->login($email, $password);

        // Vérification du statut de la réponse
        if (!$loginResult->status) {
            $message = $loginResult->message;
        } else {
            $message = $loginResult->message;

            // Vérification si l'utilisateur est un administrateur
            if (isset($_SESSION['auth_admin'])) {
                header('Location: /atelier_mrt/admin');
                exit;
            }

            // Redirection après connexion réussie
            header('Location: /atelier_mrt');
            exit;
        }
    }
}
