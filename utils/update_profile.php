<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['prenom'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';

    // ID de l'utilisateur (doit être déterminé selon votre logique d'authentification)
    session_start();
    $userId = $_SESSION['user_id'];

    // Création du contrôleur des clients
    $result = CustomerController::updateProfile($pdo, $userId, $prenom, $nom, $email, $telephone);

    echo json_encode($result);
}
