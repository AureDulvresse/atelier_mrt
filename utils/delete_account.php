<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ID de l'utilisateur (doit être déterminé selon votre logique d'authentification)
    session_start();
    $userId = $_SESSION['user_id'];

    $result = CustomerController::deleteAccount($pdo, $userId);

    echo json_encode($result);
}
