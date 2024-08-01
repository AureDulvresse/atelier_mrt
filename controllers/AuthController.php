<?php

use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;
require 'models/Customer.php';

class AuthController
{
    private $pdo;
    private $auth;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $config = new PHPAuthConfig($pdo);
        $this->auth = new PHPAuth($pdo, $config);
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeatpassword = $_POST['repeatpassword'];

            if ($password !== $repeatpassword) {
                echo "Les mots de passe ne correspondent pas.";
                return;
            }

            // Enregistrement avec PHPAuth
            $register = $this->auth->register($email, $password, $repeatpassword, [
                'username' => $username,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $password
            ]);

            if ($register['error'] == true) {
                echo $register['message'];
            } else {
                $customer = new Customer($username, $first_name, $last_name, $email, $password);
                if ($customer->save($this->pdo)) {
                    echo "Enregistrement réussi. Veuillez vérifier votre email pour activer votre compte.";
                } else {
                    echo "Erreur lors de l'enregistrement.";
                }
            }
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $login = $this->auth->login($email, $password);

            if ($login['error'] == true) {
                echo $login['message'];
            } else {
                // Mettre à jour la date de dernière connexion
                $customer = Customer::findByEmail($this->pdo, $email);
                $customer->last_login = date('Y-m-d H:i:s');
                $customer->update($this->pdo);

                // Stocker le hash de session dans la session PHP
                $_SESSION['auth_hash'] = $login['hash'];

                echo "Connexion réussie.";
                // Rediriger ou effectuer une action après connexion
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['auth_hash'])) {
            $hash = $_SESSION['auth_hash'];
            $this->auth->logout($hash);
            unset($_SESSION['auth_hash']);
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
?>
