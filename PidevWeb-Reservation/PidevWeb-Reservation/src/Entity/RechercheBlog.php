<?php

namespace App\Entity;

class RechercheBlog
{

    private $email_blg;


    public function getEmailBlg(): ?string
    {
        return $this->email_blg;
    }

    public function setEmailBlg(string $email_blg): self
    {
        $this->email_blg = $email_blg;

        return $this;
    }
}
