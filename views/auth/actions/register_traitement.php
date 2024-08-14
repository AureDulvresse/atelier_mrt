<?php


// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

use App\Controllers\AuthController;

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
        $message = ['error' => 'Token CSRF invalide.'];
    } else {
        // Appel au contrôleur pour l'inscription
        $response = $authController->register($firstName, $lastName, $email, $password, $repeatPassword);

        if ($response->status) {
            // Enregistrement réussi
            $_SESSION['message_register'] = $response->message;
            header("Location: /login");
        } else {
            // Enregistrement échoué
            $_SESSION['message_register'] = $response->message;
            // Vous pouvez également afficher les erreurs spécifiques
            // var_dump($response->errors);
            header("Location: /register");
        }
        exit;

    }
}
