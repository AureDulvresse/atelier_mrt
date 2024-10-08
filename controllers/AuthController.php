<?php

namespace App\Controllers;

use App\Models\Cart;
use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;

use App\Models\Customer;
use App\Utils\Response;

class AuthController
{
    private $pdo;
    private $auth;

    private $registerMessage = '';

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $config = new PHPAuthConfig($pdo);
        $this->auth = new PHPAuth($pdo, $config);
    }

    public function registerMessage()
    {
        return $this->registerMessage;
    }


    public function register($firstName, $lastName, $email, $password, $repeatPassword)
    {
        // Vérification des mots de passe
        if ($password !== $repeatPassword) {
            return new Response(false, "Les mots de passe ne correspondent pas.", ["password_mismatch" => "Les mots de passe ne correspondent pas."]);
        }

        // Enregistrement avec PHPAuth
        $register = $this->auth->register($email, $password, $repeatPassword);

        if ($register['error'] == true) {
            return new Response(false, $register['message'], ["auth_error" => $register['message']]);
        } else {
            $customer = new Customer($firstName, $lastName, $email, $password, 0, 0, 1);
            if ($customer->save($this->pdo)) {
                return new Response(true, "Enregistrement réussi. Veuillez vérifier votre email pour activer votre compte.");
            } else {
                return new Response(false, "Erreur lors de l'enregistrement.", ["db_error" => "Impossible de sauvegarder le client dans la base de données."]);
            }
        }
    }

    public function login($email, $password): Response
    {
        // Authentifier l'utilisateur
        $login = $this->auth->login($email, $password);

        // Vérifier si l'authentification a échoué
        if ($login['error']) {
            return new Response(false, $login['message']);
        }

        // Récupérer le client par email
        $customer = Customer::findByEmail($this->pdo, $email);

        // Vérifier si le client a été trouvé
        if ($customer === null) {
            return new Response(false, 'Utilisateur non trouvé.');
        }

        // Mettre à jour la date de dernière connexion
        $customer->last_login = date('Y-m-d H:i:s');
        $customer->update($this->pdo);

        // Stocker le hash de session dans la session PHP
        $_SESSION['auth_hash'] = $login['hash'];

        // Vérifier les rôles de l'utilisateur et mettre à jour la session
        if ($customer->is_staff && $customer->is_superuser) {
            $_SESSION['auth_admin'] = bin2hex(random_bytes(32));
        }

        // Récupérer ou créer le panier de l'utilisateur
        $cart = Cart::get($this->pdo, $customer->id);
        if (empty($cart)) {
            $cart = Cart::create($this->pdo, $customer->id);
        }

        $_SESSION['cart'] = $cart['id'];
        $_SESSION['current_id'] = $customer->id;

        return new Response(true, 'Connexion réussie.');
    }


    public function logout()
    {
        if (isset($_SESSION['auth_hash'])) {
            $hash = $_SESSION['auth_hash'];
            $this->auth->logout($hash);
            unset($_SESSION['auth_hash']);
            unset($_SESSION['cart']);
            unset($_SESSION['current_id']);
            header('Location: /atelier_mrt');
        } else {
            echo "Erreur lors de la déconnexion.";
        }
    }

    public function activate($token)
    {
        $activation = $this->auth->activate($token);

        if ($activation['error'] == true) {
            echo $activation['message'];
        } else {
            echo "Activation réussie. Vous pouvez maintenant vous connecter.";
        }
    }

    public function forgotPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $forgot = $this->auth->requestReset($email);

            if ($forgot['error'] == true) {
                echo $forgot['message'];
            } else {
                echo "Un email de réinitialisation de mot de passe a été envoyé.";
            }
        }
    }

    public function resetPassword($key, $password, $repeatpassword)
    {
        $reset = $this->auth->resetPass($key, $password, $repeatpassword);

        if ($reset['error'] == true) {
            echo $reset['message'];
        } else {
            echo "Mot de passe réinitialisé avec succès. Vous pouvez maintenant vous connecter.";
        }
    }
}
