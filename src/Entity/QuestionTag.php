<?php

namespace App\Entity;

use App\Repository\QuestionTagRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionTagRepository::class)
 */
class QuestionTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="questionTags")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity=Tag::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $tag;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $taggetAt;

    public function __construct()
    {
        $this->taggetAt  = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    public function setTag(?Tag $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTaggetAt(): ?\DateTimeImmutable
    {
        return $this->taggetAt;
    }

    public function setTaggetAt(\DateTimeImmutable $taggetAt): self
    {
        $this->taggetAt = $taggetAt;

        return $this;
    }
}
