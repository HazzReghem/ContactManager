<?php

class ContactManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Requête SQL pour récupérer des contacts de la table (fetch_assoc = tableau associatif)
    // & retour d'un tableau d'objets "Contact"
    public function findAll(): array {
        try {
            $stmt = $this->pdo->query('SELECT * FROM contact');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $contacts = [];
            foreach ($results as $row) {
                $contact = new Contact($row['id'], $row['name'], $row['email'], $row['phone_number']);
                $contacts[] = $contact;
            }
            return $contacts;
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            return [];
        }
    }

    // Methode fondById pour rechercher un contact par ID, et retourne null si aucun ne correspond
    public function findById(int $id): ?Contact {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM contact WHERE id = :id');
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Contact($row['id'], $row['name'], $row['email'], $row['phone_number']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            return null;
        }
    }

    public function create(string $name, string $email, string $phoneNumber): bool{
        try {
            $stmt = $this->pdo->prepare('INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)');
            $stmt->execute(['name' => $name, 'email' => $email, 'phone_number' => $phoneNumber]);
            return true;
        } catch (PDOException $e) {
            echo 'Insert failed: ' . $e->getMessage();
            return false;
        }
    }

    public function deleteById(int $id): bool {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM contact WHERE id = :id');
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            echo 'Delete failed: ' . $e->getMessage();
            return false;
        }
    }
}
?>