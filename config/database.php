<?php
// config/database.php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Paramètres de la base de données
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

// Vérifier les valeurs des variables d'environnement
if (!$host || !$dbname || !$user || $pass === false) {
    die('Erreur: Une ou plusieurs variables d\'environnement de la base de données ne sont pas définies.');
}



// Créer une instance de PDO pour la connexion à la base de données
try {
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

// Retourne l'instance PDO
return $pdo;
