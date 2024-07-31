<?php

class ArtworkController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addOrder()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $uuid = $_POST['uuid'];
            $quantity = $_POST['quantity'];
            $ordered = $_POST['ordered'];
            $ordered_at = $_POST['ordered_at'];
            $artwork_id = $_POST['artwork_id'];
            $customer_id = $_POST['customer_id'];

            try {
                // Préparer la requête d'insertion
                $sql = "INSERT INTO `order` (uuid, quantity, ordered, created_at, updated_at, ordered_at, artwork_id, customer_id)
                        VALUES (:uuid, :quantity, :ordered, NOW(), NOW(), :ordered_at, :artwork_id, :customer_id)";

                // Préparer et exécuter la requête avec les paramètres
                $stmt = $this->pdo->prepare($sql);
                $params = [
                    ':uuid' => $uuid,
                    ':quantity' => $quantity,
                    ':ordered' => $ordered,
                    ':ordered_at' => $ordered_at,
                    ':artwork_id' => $artwork_id,
                    ':customer_id' => $customer_id
                ];

                if ($stmt->execute($params)) {
                    echo "Nouvelle commande créée avec succès.";
                } else {
                    echo "Erreur lors de l'insertion de la commande.";
                }
            } catch (PDOException $e) {
                echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
            }
        }
    }

    public function deleteOrder($id)
    {
        try {
            // Préparer la requête de suppression
            $sql = "DELETE FROM `order` WHERE id = :id";

            // Préparer et exécuter la requête avec le paramètre ID
            $stmt = $this->pdo->prepare($sql);
            $params = [
                ':id' => $id
            ];

            if ($stmt->execute($params)) {
                echo "Commande supprimée avec succès.";
            } else {
                echo "Erreur lors de la suppression de la commande.";
            }
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
        }
    }

    public function editOrder($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $uuid = $_POST['uuid'];
            $quantity = $_POST['quantity'];
            $ordered = $_POST['ordered'];
            $ordered_at = $_POST['ordered_at'];
            $artwork_id = $_POST['artwork_id'];
            $customer_id = $_POST['customer_id'];

            try {
                // Préparer la requête de mise à jour
                $sql = "UPDATE `order` 
                        SET uuid = :uuid, quantity = :quantity, ordered = :ordered, updated_at = NOW(), 
                            ordered_at = :ordered_at, artwork_id = :artwork_id, customer_id = :customer_id 
                        WHERE id = :id";

                // Préparer et exécuter la requête avec les paramètres
                $stmt = $this->pdo->prepare($sql);
                $params = [
                    ':uuid' => $uuid,
                    ':quantity' => $quantity,
                    ':ordered' => $ordered,
                    ':ordered_at' => $ordered_at,
                    ':artwork_id' => $artwork_id,
                    ':customer_id' => $customer_id,
                    ':id' => $id
                ];

                if ($stmt->execute($params)) {
                    echo "Commande mise à jour avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour de la commande.";
                }
            } catch (PDOException $e) {
                echo 'Erreur lors de l\'exécution de la requête : ' . $e->getMessage();
            }
        }
    }


}
