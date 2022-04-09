<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
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

    #[ORM\OneToMany(mappedBy: 'question_id', targetEntity: Media::class)]
    private $media_id;

    public function __construct()
    {
        $this->media_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getExplanation(): ?string
    {
        return $this->explanation;
    }

    public function setExplanation(?string $explanation): self
    {
        $this->explanation = $explanation;

        return $this;
    }

    public function getAnswer(): array
    {
        return $this->answer;
    }

    public function setAnswer(array $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMediaId(): Collection
    {
        return $this->media_id;
    }

    public function addMediaId(Media $mediaId): self
    {
        if (!$this->media_id->contains($mediaId)) {
            $this->media_id[] = $mediaId;
            $mediaId->setQuestionId($this);
        }

        return $this;
    }

    public function removeMediaId(Media $mediaId): self
    {
        if ($this->media_id->removeElement($mediaId)) {
            // set the owning side to null (unless already changed)
            if ($mediaId->getQuestionId() === $this) {
                $mediaId->setQuestionId(null);
            }
        }

        return $this;
    }
}
