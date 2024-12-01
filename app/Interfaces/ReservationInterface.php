<?php

namespace App\Interfaces;

use DateTime;

interface ReservationInterface {
    public function getNo(): int;
    public function getUser(): string;
    public function getDateDebut(): Datetime;
    public function getDateFin(): DateTime;
}
?>