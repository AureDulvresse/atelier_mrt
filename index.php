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

// Définir les chemins d'accès aux ressources
define('ASSETS_PATH', '/atelier_mrt/assets');

// Fonction pour inclure les ressources CSS
function includeCSS($filename)
{
    echo '<link rel="stylesheet" href="' . ASSETS_PATH . '/css/' . $filename . '">';
}

// Fonction pour inclure les scripts JS
function includeJS($filename)
{
    echo '<script src="' . ASSETS_PATH . '/js/' . $filename . '" defer></script>';
}

$artist_banner = ASSETS_PATH . '/images/artist_banner.jpg';

// Définir le titre de la page par défaut
$pageTitle = 'Accueil - Atelier MRT';

// Gérer le routage et définir le titre en fonction de la page
switch ($request) {
    case '':
    case '/':
        $pageTitle = 'Accueil - Atelier MRT';
        require __DIR__ . '/views/index.php';
        break;
    case '/login':
        $pageTitle = 'Connexion - Atelier MRT';
        require __DIR__ . '/views/auth/login.php';
        break;
    case '/register':
        $pageTitle = 'Inscription - Atelier MRT';
        require __DIR__ . '/views/auth/register.php';
        break;
    case '/contact':
        $pageTitle = 'Contact - Atelier MRT';
        require __DIR__ . '/views/mail/contact.php';
        break;
    case '/admin':
        $pageTitle = 'Administration - Atelier MRT';
        require __DIR__ . '/views/admin/dashboard.php';
        break;
    case '/admin/edit_painting':
        $pageTitle = 'Éditer une œuvre - Atelier MRT';
        require __DIR__ . '/views/admin/edit_painting.php';
        break;
    case '/order/checkout':
        $pageTitle = 'Commande - Atelier MRT';
        require __DIR__ . '/views/order/checkout.php';
        break;
    default:
        $pageTitle = 'Page Non Trouvée - Atelier MRT';
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
