<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;
use DateTimeInterface;

trait DeletedAtTrait
{
    public function setDeletedAt ()
    {
        $date = DateTime::createFromFormat('', '', new DateTimeZone('Europe/Paris'));
        $this->deletedAt = $date;
    }

    public function getDeletedAt (): ?DateTimeInterface
    {
        return $this->deletedAt;
    }
}