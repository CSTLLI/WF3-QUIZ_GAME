<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
class Exercise
{

/* ------------------------------------------------------------- COMPOSANT ------------------------------------------------------------------ */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $title;

/* --------------------------------------------------------------- RELATION ----------------------------------------------------------------- */

    #[ORM\OneToMany(mappedBy: 'exercise', targetEntity: Question::class, orphanRemoval: true)]
    private $question;

    #[ORM\OneToMany(mappedBy: 'exercise', targetEntity: Result::class)]
    private $results;
    
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'exercises')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToOne(targetEntity: Difficulty::class, inversedBy: 'exercises')]
    #[ORM\JoinColumn(nullable: false)]
    private $difficulty;

/* ------------------------------------------------------------ CONSCTRUCTEUR --------------------------------------------------------------- */

    public function __construct()
    {
        $this->question = new ArrayCollection();
        $this->results = new ArrayCollection();
    }

/* ---------------------------------------------------------------- GETTER ------------------------------------------------------------------ */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

/* ---------------------------------------------------------------- SETTER ------------------------------------------------------------------ */

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

/* ---------------------------------------------------------- RELATION (QUESTION) ----------------------------------------------------------- */

    /**
     * @return Collection<int, Question>
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->question->contains($question)) {
            $this->question[] = $question;
            $question->setExercise($this);
        }
        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->question->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getExercise() === $this) {
                $question->setExercise(null);
            }
        }
        
        return $this;
    }

/* ----------------------------------------------------------- RELATION (RESULT) ------------------------------------------------------------ */

    /**      
     * @return Collection<int, Result>
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    public function addResult(Result $result): self
    {
        if (!$this->results->contains($result)) {
            $this->results[] = $result;
            $result->setExercise($this);
        }

        return $this;
    }

    public function removeResult(Result $result): self
    {
        if ($this->results->removeElement($result)) {
            // set the owning side to null (unless already changed)
            if ($result->getExercise() === $this) {
                $result->setExercise(null);
            }
        }

        return $this;
    }

/* ---------------------------------------------------------- RELATION (CATEGORY) ----------------------------------------------------------- */

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

/* --------------------------------------------------------- RELATION (DIFFICULTY) ---------------------------------------------------------- */

    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulty $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    
}
