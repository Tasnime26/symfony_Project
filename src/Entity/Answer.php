<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Problem;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\AnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
#[ApiResource]
#[ApiResource(
    uriTemplate: '/problems/{id}/answers', 
    uriVariables: [
        'id' => new Link(
            fromClass: Problem::class,
            fromProperty: 'answers'
        )
    ], 
    operations: [new GetCollection()]
)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    private ?Problem $problem = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProblem(): ?Problem
    {
        return $this->problem;
    }

    public function setProblem(?Problem $problem): self
    {
        $this->problem = $problem;

        return $this;
    }
}
