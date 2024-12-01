<?php

namespace App\Interfaces;

interface AdminInterface extends UserInterface {
    public function suiviMail(): void;
    public function gestionStaff(): void;
    public function modifierChambre(): void;
    public function suiviReservation(): void;
    public function ajoutEquipement(): void;
}
?>
