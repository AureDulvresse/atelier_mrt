<?php
// config/services.php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    'stripe' => [
        'secret_key' => $_ENV['STRIPE_SECRET_KEY'],
        'publishable_key' => $_ENV['STRIPE_PUBLISHABLE_KEY'],
    ],
    'paypal' => [
        'client_id' => $_ENV['PAYPAL_CLIENT_ID'],
        'secret' => $_env['PAYPAL_SECRET'],
        'sandbox' => $_env['PAYPAL_SANDBOX'] === 'true',
    ],
];
