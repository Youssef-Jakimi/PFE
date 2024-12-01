<?php

namespace App\Interfaces;

use DateTime;

interface FactureInterface {
    public function getId(): int;
    public function getTotal(): float;
    public function getStatue(): bool;
    public function getDatePaiement():DateTime;
}
?>