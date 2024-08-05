<?php
// config/services.php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    'stripe' => [
        'secret_key' => getenv('STRIPE_SECRET_KEY'),
        'publishable_key' => getenv('STRIPE_PUBLISHABLE_KEY'),
    ],
    'paypal' => [
        'client_id' => getenv('PAYPAL_CLIENT_ID'),
        'secret' => getenv('PAYPAL_SECRET'),
        'sandbox' => getenv('PAYPAL_SANDBOX') === 'true',
    ],
];
