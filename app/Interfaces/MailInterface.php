<?php

namespace App\Interfaces;

use DateTime;

interface MailInterface {
    public function getNo(): int;
    public function getEmetteur(): string;
    public function getRecepteur(): string;
    public function getContenu(): string;
    public function getDate():DateTime;
}
?>