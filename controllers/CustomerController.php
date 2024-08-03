<?php

class CustomerController
{
    // private $conn;

    // public function __construct($conn)
    // {
    //     $this->conn = $conn;
    // }

    public static function updateProfile($db, $userId, $prenom, $nom, $email, $telephone)
    {
        $sql = "UPDATE customers SET prenom = ?, nom = ?, email = ?, telephone = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssi", $prenom, $nom, $email, $telephone, $userId);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Profil mis à jour avec succès.'];
        } else {
            return ['status' => 'error', 'message' => 'Erreur lors de la mise à jour du profil.'];
        }
    }

    public static function deleteAccount($db, $userId)
    {
        $sql = "DELETE FROM customers WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            // Détruire la session de l'utilisateur après la suppression
            session_destroy();
            return ['status' => 'success', 'message' => 'Compte supprimé avec succès.'];
        } else {
            return ['status' => 'error', 'message' => 'Erreur lors de la suppression du compte.'];
        }
    }
}
