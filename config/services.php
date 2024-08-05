<?php
// config/services.php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$stripePublishableKey = $_ENV['STRIPE_PUBLISHABLE_KEY'];
$stripeSecretKey = $_ENV['STRIPE_SECRET_KEY'];

$paypalClientId = $_ENV['PAYPAL_CLIENT_ID'];
$paypalSecret = $_ENV['PAYPAL_SECRET'];
$paypalSandbox = $_ENV['PAYPAL_SANDBOX'];

if (!$stripePublishableKey || !$stripeSecretKey || !$paypalClientId || !$paypalSecret || !$paypalSandbox === false) {
    die('Erreur: Une ou plusieurs variables d\'environnement de la base de données ne sont pas définies.');
}


return [
    'stripe' => [
        'secret_key' => $stripeSecretKey,
        'publishable_key' => $stripePublishableKey,
    ],
    'paypal' => [
        'client_id' => $paypalClientId,
        'secret' => $paypalSecret,
        'sandbox' => $paypalSandbox === 'true',
    ],
];
