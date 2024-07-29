<?php
session_start();
require_once 'config/config.php';

// Obtenez l'URI de la requête
$request = $_SERVER['REQUEST_URI'];

// Supprimez le préfixe du projet de l'URI
$prefix = '/atelier_mrt';
if (strpos($request, $prefix) === 0) {
    $request = substr($request, strlen($prefix));
}

// // Debug : Affichez la requête pour vérifier le routage
// echo $request;

switch ($request) {
    case '':
    case '/':
        require __DIR__ . '/views/index.php';
        break;
    case '/login':
        require __DIR__ . '/views/auth/login.php';
        break;
    case '/register':
        require __DIR__ . '/views/auth/register.php';
        break;
    case '/contact':
        require __DIR__ . '/views/mail/contact.php';
        break;
    case '/admin':
        require __DIR__ . '/views/admin/dashboard.php';
        break;
    case '/admin/edit_painting':
        require __DIR__ . '/views/admin/edit_painting.php';
        break;
    case '/order/checkout':
        require __DIR__ . '/views/order/checkout.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
