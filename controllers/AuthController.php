<?php

namespace App\Controllers;

use App\Models\Cart;
use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;

use App\Models\Customer;

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


        if ($password !== $repeatPassword) {
            $this->registerMessage =  ["error" => "Les mots de passe ne correspondent pas."];
            return $this->registerMessage;
        }

        // Enregistrement avec PHPAuth
        $register = $this->auth->register($email, $password, $repeatPassword);

        if ($register['error'] == true) {
            $this->registerMessage = $register['message'];
        } else {
            $customer = new Customer($firstName, $lastName, $email, $password);
            if ($customer->save($this->pdo)) {
                $this->registerMessage = "Enregistrement réussi. Veuillez vérifier votre email pour activer votre compte.";
            } else {
                $this->registerMessage = "Erreur lors de l'enregistrement.";
            }
        }
        return $this->registerMessage;
    }

    public function login($email, $password)
    {
        $login = $this->auth->login($email, $password);

        if ($login['error'] == true) {
            return $login['message'];
        } else {
            // Mettre à jour la date de dernière connexion
            $customer = Customer::findByEmail($this->pdo, $email);
            $customer->last_login = date('Y-m-d H:i:s');
            $customer->update($this->pdo);

            var_dump($customer);

            // Stocker le hash de session dans la session PHP
            $_SESSION['auth_hash'] = $login['hash'];

            // Récuperer le panier de l'utilisateur
            $cart = Cart::get($this->pdo, $customer->id);

            if (empty($cart)) {
                $cart = Cart::create($this->pdo, $customer->id);
            }
            
            $_SESSION['cart'] = $cart;
            $_SESSION['current_id'] = $customer->id;

            echo "Connexion réussie.";
        }
    }

    public function logout()
    {
        if (isset($_SESSION['auth_hash'])) {
            $hash = $_SESSION['auth_hash'];
            $this->auth->logout($hash);
            unset($_SESSION['auth_hash']);
            unset($_SESSION['cart']);
            unset($_SESSION['current_id']);
            echo "Déconnexion réussie.";
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
