<?php

namespace App\Entity;

class RechercheReservation
{

    private $email_res;


    public function getEmailRes(): ?string
    {
        return $this->email_res;
    }

    public function setEmailRes(string $email_res): self
    {
        $this->email_res = $email_res;

        return $this;
    }
}

