<?php

class DBConnect {
    // $pdo stocke l'objet PDO
    private $pdo;

    // Initialisation de la connexion PDO 
    public function __construct($dsn, $username, $password) {
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }

    // Retour de l'instance PDO (pour pouvoir l'utiliser)
    public function getPDO() {
        return $this->pdo;
    }
}
?>