<?php

namespace App\Entity;

use App\Repository\ResultRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultRepository::class)]
class Result
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $grades;

    #[ORM\Column(type: 'datetime_immutable')]
    private $update_at;

    #[ORM\ManyToOne(targetEntity: Exercise::class, inversedBy: 'results')]
    #[ORM\JoinColumn(nullable: false)]
    private $exercise;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'results')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;


    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->exercise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrades(): ?int
    {
        return $this->grades;
    }

    public function setGrades(int $grades): self
    {
        $this->grades = $grades;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeImmutable $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): self
    {
        $this->exercise = $exercise;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }




}
