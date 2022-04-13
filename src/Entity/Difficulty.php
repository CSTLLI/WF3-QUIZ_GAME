<?php

namespace App\Entity;

use App\Repository\DifficultyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DifficultyRepository::class)]
class Difficulty
{

/* ------------------------------------------------------------- COMPOSANT ------------------------------------------------------------------ */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $timer;

/* --------------------------------------------------------------- RELATION ----------------------------------------------------------------- */

    #[ORM\OneToMany(mappedBy: 'difficulty', targetEntity: Exercise::class)]
    private $exercises;

/* ------------------------------------------------------------ CONSCTRUCTEUR --------------------------------------------------------------- */

 public function __construct()
    {
        $this->exercises = new ArrayCollection();
    }

/* ---------------------------------------------------------------- GETTER ------------------------------------------------------------------ */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getTimer(): ?int
    {
        return $this->timer;
    }

/* ---------------------------------------------------------------- SETTER ------------------------------------------------------------------ */

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setTimer(int $timer): self
    {
        $this->timer = $timer;

        return $this;
    }

/* ---------------------------------------------------------- RELATION (EXERCISE) ----------------------------------------------------------- */

    /**
     * @return Collection<int, Exercise>
     */
    public function getExercises(): Collection
    {
        return $this->exercises;
    }

    public function addExercise(Exercise $exercise): self
    {
        if (!$this->exercises->contains($exercise)) {
            $this->exercises[] = $exercise;
            $exercise->setDifficulty($this);
        }

        return $this;
    }

    public function removeExercise(Exercise $exercise): self
    {
        if ($this->exercises->removeElement($exercise)) {
            // set the owning side to null (unless already changed)
            if ($exercise->getDifficulty() === $this) {
                $exercise->setDifficulty(null);
            }
        }

        return $this;
    }


}
