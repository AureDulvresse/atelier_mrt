<?php
// config/services.php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$stripePublishableKey = $_ENV['STRIPE_PUBLISHABLE_KEY'] ?? null;
$stripeSecretKey = $_ENV['STRIPE_SECRET_KEY'] ?? null;

$paypalClientId = $_ENV['PAYPAL_CLIENT_ID'] ?? null;
$paypalSecret = $_ENV['PAYPAL_SECRET'] ?? null;
$paypalSandbox = $_ENV['PAYPAL_SANDBOX'] ?? null;

if (!$stripePublishableKey || !$stripeSecretKey || !$paypalClientId || !$paypalSecret || !isset($paypalSandbox)) {
    die('Erreur: Une ou plusieurs variables d\'environnement ne sont pas définies.');
}

return [
    'stripe' => [
        'secret_key' => $stripeSecretKey,
        'publishable_key' => $stripePublishableKey,
    ],
    'paypal' => [
        'client_id' => $paypalClientId,
        'secret' => $paypalSecret,
        'sandbox' => filter_var($paypalSandbox, FILTER_VALIDATE_BOOLEAN),
    ],
];
