<?php

namespace App\Entity;

use App\Repository\QuestionRepository;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{

/* ------------------------------------------------------------- COMPOSANT ------------------------------------------------------------------ */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $explanation;

    #[ORM\Column(type: 'array', length: 255, nullable: false)]
    private $answer;

/* --------------------------------------------------------------- RELATION ----------------------------------------------------------------- */

    #[ORM\OneToOne(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    private $media;

    #[ORM\ManyToOne(targetEntity: Exercise::class, inversedBy: 'question')]
    #[ORM\JoinColumn(nullable: false)]
    private $exercise;

/* ---------------------------------------------------------------- GETTER ------------------------------------------------------------------ */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function getExplanation(): ?string
    {
        return $this->explanation;
    }

    public function getAnswer(): array
    {
        return $this->answer;
    }

/* ---------------------------------------------------------------- SETTER ------------------------------------------------------------------ */

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setExplanation(?string $explanation): self
    {
        $this->explanation = $explanation;

        return $this;
    }

    public function setAnswer(array $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

/* ------------------------------------------------------------ RELATION (MEDIA) -------------------------------------------------------------- */

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(?Media $media): self
    {
        $this->media = $media;

        return $this;
    }

/* ----------------------------------------------------------- RELATION (EXERCISE) ------------------------------------------------------------ */

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): self
    {
        $this->exercise = $exercise;

        return $this;
    }

}
