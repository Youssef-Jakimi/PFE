<?php

namespace App\Interfaces;

class UserInterface {
    private $name;
    private $email;
    private $password;
    private $telephone;

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function seConnecter(string $email, string $password): void {    
    }

    public function checkIn(): void {   
    }

    public function checkOut(): void {
    }

    public function rechercher(): void {
    }

    public function payer(): void {
    }

    public function reserver(): void {
    }

    public function contactSupp(): void {
    }
}
?>