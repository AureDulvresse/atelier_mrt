<?php
session_start();
require_once 'config/config.php';

// Afficher les erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
        $pageTitle = 'Accueil';
        require __DIR__ . '/views/index.php';
        break;
    case '/contact':
        $pageTitle = 'Contact';
        require __DIR__ . '/views/mail/contact.php';
        break;
    case '/shop':
        $pageTitle = 'Boutique';
        require __DIR__ . '/views/shop/gallery.php';
        break;
    case (preg_match('/^\/shop\/artwork\/(\d+)$/', $request, $matches) ? true : false):
        $pageTitle = 'Détail de l\'œuvre';
        $_GET['id'] = $matches[1];
        require __DIR__ . '/views/shop/artwork.php';
        break;
    case '/blog':
        $pageTitle = 'Blog';
        require __DIR__ . '/views/blog/blog.php';
        break;
    case (preg_match('/^\/blog\/post\/(\d+)$/', $request, $matches) ? true : false):
        $pageTitle = 'Détail de l\'article';
        $_GET['id'] = $matches[1];
        require __DIR__ . '/views/blog/post.php';
        break;
    case '/login':
        $pageTitle = 'Connexion';
        require __DIR__ . '/views/auth/login.php';
        break;
    case '/register':
        $pageTitle = 'Inscription';
        require __DIR__ . '/views/auth/register.php';
        break;

    case '/forgot-password':
        $pageTitle = 'Réinitialiser le mot de passe';
        require __DIR__ . '/views/auth/forgot-password.php';
        break;
    case '/reset-password':
        $pageTitle = 'Réinitialiser le mot de passe';
        require __DIR__ . '/views/auth/reset-password.php';
        break;
    case '/order/checkout':
        $pageTitle = 'Commande';
        require __DIR__ . '/views/order/checkout.php';
        break;
    case '/admin':
        $pageTitle = 'Administration';
        require __DIR__ . '/views/admin/dashboard.php';
        break;
    case '/admin/artwork/edit':
        $pageTitle = 'Éditer une œuvre';
        require __DIR__ . '/views/admin/edit_painting.php';
        break;
    default:
        $pageTitle = 'Page Non Trouvée';
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
