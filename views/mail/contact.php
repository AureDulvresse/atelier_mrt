<?php

use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// Vérifier si les données ont été envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $prenom = $_POST['prenom'] ?? '';
  $nom = $_POST['nom'] ?? '';
  $telephone = $_POST['telephone'] ?? '';
  $email = $_POST['email'] ?? '';
  $message = $_POST['message'] ?? '';

  // Validation des données (à adapter selon les besoins)
  if (empty($prenom) || empty($nom) || empty($email) || empty($message)) {
    echo json_encode(['status' => 'error', 'message' => 'Tous les champs sont requis.']);
    exit;
  }

  // Création de l'instance PHPMailer
  $mail = new PHPMailer(true);

  try {
    // Configurations du serveur
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';                             // Hôte du serveur SMTP pour Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'adentrepreneur02@gmail.com';             // Adresse email Gmail
    $mail->Password = 'Afuld qxjp jmov aeyf';                   // Mot de passe Gmail (ou mot de passe d'application)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    // Expéditeur et destinataire
    $mail->setFrom('adentrepreneur02@gmail.com', 'Atelier mrt'); // Adresse email de l'expéditeur
    $mail->addAddress('adentrepreneur02@gmail.com', ''); // Adresse email du destinataire


    // Contenu de l'email
    $mail->isHTML(true);
    $mail->Subject = 'Nouveau message de contact';

    // Corps de l'email avec du style
    $mail->Body = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 80%;
                    margin: auto;
                    background: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .header {
                    text-align: center;
                    padding-bottom: 20px;
                }
                .header img {
                    max-width: 150px;
                }
                .content {
                    margin-bottom: 20px;
                }
                .content p {
                    margin: 10px 0;
                }
                .footer {
                    text-align: center;
                    padding-top: 20px;
                    font-size: 12px;
                    color: #666;
                }
                .footer a {
                    color: #1a73e8;
                    text-decoration: none;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <img src='https://yourdomain.com/path/to/logo.png' alt='Logo de l\'atelier MRT'>
                </div>
                <div class='content'>
                    <p><strong>Prénom:</strong> $prenom</p>
                    <p><strong>Nom:</strong> $nom</p>
                    <p><strong>Téléphone:</strong> $telephone</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Message:</strong></p>
                    <p>$message</p>
                </div>
                <div class='footer'>
                    <p>Merci de nous avoir contacté. Nous vous répondrons dans les plus brefs délais.</p>
                    <p><a href='https://yourdomain.com'>Visitez notre site web</a></p>
                </div>
            </div>
        </body>
        </html>";

    // Envoi de l'email
    $mail->send();
    echo json_encode(['status' => 'success', 'message' => 'Message envoyé avec succès.']);
  } catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Le message n\'a pas pu être envoyé. Erreur: ' . $mail->ErrorInfo]);
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée.']);
}
