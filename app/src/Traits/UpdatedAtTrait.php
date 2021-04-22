<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;
use DateTimeInterface;

trait UpdatedAtTrait
{
    public function setUpdatedAt ()
    {
        $date = DateTime::createFromFormat('', '', new DateTimeZone('Europe/Paris'));
        $this->updatedAt = $date;
    }

    public function getUpdatedAt (): ?DateTimeInterface
    {
        return $this->updatedAt;
    }
}