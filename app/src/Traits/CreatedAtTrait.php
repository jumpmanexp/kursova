<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;
use DateTimeInterface;

trait CreatedAtTrait
{
    public function setCreatedAt ()
    {
        $date = DateTime::createFromFormat('', '', new DateTimeZone('Europe/Paris'));
        $this->createdAt = $date;
    }

    public function getCreatedAt (): DateTimeInterface
    {
        return $this->createdAt;
    }
}