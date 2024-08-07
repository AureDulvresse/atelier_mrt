<?php
session_start();

// Charger la configuration de la base de données et créer l'instance PDO
$pdo = require __DIR__ . '/config/database.php';

// Charger la configuration des services tiers
$services = require __DIR__ . '/config/services.php';

// Utiliser les configurations
$stripeSecretKey = $services['stripe']['secret_key'];
$stripePublishableKey = $services['stripe']['publishable_key'];
$paypalClientId = $services['paypal']['client_id'];
$paypalSecret = $services['paypal']['secret'];
$paypalSandbox = $services['paypal']['sandbox'];

// // PayPal SDK initialisation
// $apiContext = new \PayPal\Rest\ApiContext(
//     new \PayPal\Auth\OAuthTokenCredential(
//         $paypalClientId,
//         $paypalSecret
//     )
// );

// $apiContext->setConfig([
//     'mode' => $paypalSandbox ? 'sandbox' : 'live'
// ]);

// Exemple d'initialisation des services
\Stripe\Stripe::setApiKey($stripeSecretKey);

// Afficher les erreurs pour le débogage
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
$pageTitle = 'Accueil';

// Vérifiez si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['auth_hash']);

$isAdministrator = isset($_SESSION['auth_admin']);

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
    case '/cart':
        $pageTitle = 'Panier';
        require __DIR__ . '/views/cart.php';
        break;
    case '/add_to_cart':
        $pageTitle = 'Add to Cart';
        require __DIR__ . '/views/shop/actions/add_to_cart.php';
        break;
    case '/checkout':
        $pageTitle = 'Checkout';
        require __DIR__ . '/views/order/checkout.php';
        break;
    case '/order/create_checkout_session':
        require __DIR__ . '/views/order/create_checkout_session.php';
        break;
    case '/success_payment':
        require __DIR__ . '/views/order/payment_success.php';
        break;
    case '/cancel_payment':
        require __DIR__ . '/views/order/payment_cancel.php';
        break;
    case (preg_match('/^\/shop\/artwork\/(\d+)$/', $request, $matches) ? true : false):
        $pageTitle = 'Détail de l\'œuvre';
        $_GET['id'] = $matches[1];
        require __DIR__ . '/views/shop/artwork-detail.php';
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
        if ($isLoggedIn) {
            header('Location: /atelier_mrt');
        } else {
            $pageTitle = 'Connexion';
            require __DIR__ . '/views/auth/login.php';
            break;
        }
    case '/register':
        $pageTitle = 'Inscription';
        require __DIR__ . '/views/auth/register.php';
        break;

    case '/logout':
        $pageTitle = 'Déconnexion';
        require __DIR__ . '/views/auth/logout.php';
        break;

    case '/forgot-password':
        $pageTitle = 'Réinitialiser le mot de passe';
        require __DIR__ . '/views/auth/forgot-password.php';
        break;
    case '/reset-password':
        $pageTitle = 'Réinitialiser le mot de passe';
        require __DIR__ . '/views/auth/reset-password.php';
        break;
    case '/profile':
        $pageTitle = 'Mon compte';
        require __DIR__ . '/views/auth/profile.php';
        break;
    case '/order/checkout':
        $pageTitle = 'Commande';
        require __DIR__ . '/views/order/checkout.php';
        break;
    case '/admin':
        if ($isAdministrator) {
            $pageTitle = 'Administration';
            require __DIR__ . '/views/admin/dashboard.php';
        } else {
            header('Location: /atelier_mrt');
        }
        break;
    case '/admin/artworks':
        if ($isAdministrator) {
            $pageTitle = 'Administration - Oeuvres';
            require __DIR__ . '/views/admin/artwork_page.php';
        } else {
            header('Location: /atelier_mrt');
        }
        break;
    case '/admin/artworks/actions':
        if ($isAdministrator) {
            $pageTitle = 'Administration - Oeuvres';
            require __DIR__ . '/views/admin/actions/artwork.php';
        } else {
            header('Location: /atelier_mrt');
        }
        break;
    default:
        $pageTitle = 'Page Non Trouvée';
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
