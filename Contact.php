<?php

class Contact {

    // Stockage des info contact
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $phoneNumber;

    // Initialisation des attributs
    public function __construct(?int $id, ?string $name, ?string $email, ?string $phoneNumber) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    // Méthodes getters & setters pour accéder et modifier les attributs

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void {
        $this->phoneNumber = $phoneNumber;
    }

    // toString  => converti en chaine de caractères pour affichage
    public function __toString(): string {
        return "ID: {$this->id}, Name: {$this->name}, Email: {$this->email}, Phone Number: {$this->phoneNumber}";
    }
}
?>
