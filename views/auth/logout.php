<?php

use App\Controllers\AuthController;

$authController = new AuthController($pdo);

$authController->logout();

