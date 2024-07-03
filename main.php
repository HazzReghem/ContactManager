<?php

require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';
require_once 'Command.php';

// Configuration de la connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=exo_p5';
$username = 'root';
$password = '';

// Création de l'objet DBConnect et appel du PDO d'au-dessus
$dbConnect = new DBConnect($dsn, $username, $password);
$pdo = $dbConnect->getPDO();

// VAR_DUMP instance
// var_dump($pdo);

// Création de l'objet ContactManager
$contactManager = new ContactManager($pdo);

// Test de la méthode findAll
// $contacts = $contactManager->findAll();
// var_dump($contacts);

// Création de l'objet Command
$command = new Command($contactManager);

// Utilisation de preg_match pour détecter la commande detail suivie d'un ID
// Extrait l'ID et appelle la méthode detail de la classe Command pour afficher le contact
while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === "list") {
        $command->list();
        // si $line correspond à 'detail' -> extrait chiffre après 'detail' et le stocke dans tableau $matches
        // Puis appel de la commande 'detail'
    } elseif (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $id = (int)$matches[1];
        $command->detail($id);
        // ([^,]+) capturer caractères séparé par la virgule
    } elseif (preg_match('/^create ([^,]+),([^,]+),([^,]+)$/', $line, $matches)) {
        $name = $matches[1];
        $email = $matches[2];
        $phoneNumber = $matches[3];
        $command->create($name, $email, $phoneNumber);
    } elseif (preg_match('/^delete (\d+)$/', $line, $matches)) {
        $id = (int)$matches[1];
        $command->delete($id);
    } else {
        echo "Vous avez saisi : $line\n";
    }
}
?>