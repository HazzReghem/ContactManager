<?php

require_once 'ContactManager.php';

class Command {
    // Appel de ContactManager
    private $contactManager;

    // Initialisation d'un instance de ContactManager
    public function __construct(ContactManager $contactManager) {
        $this->contactManager = $contactManager;
    }

    // Appel du findAll de ContactManager pour récupérer les contacts et les afficher grâce au __toString de Contact
    public function list(): void {
        echo "Affichage de la liste\n";
        $contacts = $this->contactManager->findAll();
        foreach ($contacts as $contact) {
            echo $contact . "\n";
        }
    }

    // Récupération du contact correspondant à l'id gràace au findById de ContactManager
    public function detail(int $id): void {
        $contact = $this->contactManager->findById($id);
        if ($contact) {
            echo $contact . "\n";
        } else {
            echo "Contact avec l'ID $id non trouvé.\n";
        }
    }

    public function create(string $name, string $email, string $phoneNumber): void {
        if ($this->contactManager->create($name, $email, $phoneNumber)) {
            echo "Contact créé avec succès.\n";
        } else {
            echo "Erreur lors de la création du contact.\n";
        }
    }

    public function delete(int $id): void {
        if ($this->contactManager->deleteById($id)) {
            echo "Contact avec l'ID $id supprimé avec succès.\n";
        } else {
            echo "Erreur lors de la suppression du contact avec l'ID $id.\n";
        }
    }
}
?>