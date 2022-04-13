<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{

/* ------------------------------------------------------------- COMPOSANT ------------------------------------------------------------------ */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $format;

    #[ORM\Column(type: 'text')]
    private $content;

/* --------------------------------------------------------------- RELATION ----------------------------------------------------------------- */



/* ---------------------------------------------------------------- GETTER ------------------------------------------------------------------ */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
    
/* ---------------------------------------------------------------- SETTER ------------------------------------------------------------------ */

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

/* ------------------------------------------------------------ RELATION (...) -------------------------------------------------------------- */




}
