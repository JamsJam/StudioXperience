<?php

namespace App\Entity;

use App\Entity\Mediatheque;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ModuleRepository;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private array $content = [];

    #[ORM\OneToOne(inversedBy: 'module', cascade: ['persist', 'remove'])]
    private ?Mediatheque $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function setContent(array $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?Mediatheque
    {
        return $this->image;
    }

    public function setImage(?Mediatheque $image): static
    {
        $this->image = $image;

        return $this;
    }
}
