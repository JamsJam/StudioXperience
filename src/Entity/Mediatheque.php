<?php

namespace App\Entity;

use App\Repository\MediathequeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediathequeRepository::class)]
class Mediatheque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $alternate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $legend = null;

    #[ORM\Column(nullable: true)]
    private ?array $chapitres = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MediaType $type = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PathType $pathType = null;

    #[ORM\OneToOne(mappedBy: 'image', cascade: ['persist', 'remove'])]
    private ?Module $module = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAlternate(): ?string
    {
        return $this->alternate;
    }

    public function setAlternate(string $alternate): static
    {
        $this->alternate = $alternate;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getLegend(): ?string
    {
        return $this->legend;
    }

    public function setLegend(?string $legend): static
    {
        $this->legend = $legend;

        return $this;
    }

    public function getChapitres(): ?array
    {
        return $this->chapitres;
    }

    public function setChapitres(?array $chapitres): static
    {
        $this->chapitres = $chapitres;

        return $this;
    }

    public function getType(): ?MediaType
    {
        return $this->type;
    }

    public function setType(?MediaType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPathType(): ?PathType
    {
        return $this->pathType;
    }

    public function setPathType(?PathType $pathType): static
    {
        $this->pathType = $pathType;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        // unset the owning side of the relation if necessary
        if ($module === null && $this->module !== null) {
            $this->module->setImage(null);
        }

        // set the owning side of the relation if necessary
        if ($module !== null && $module->getImage() !== $this) {
            $module->setImage($this);
        }

        $this->module = $module;

        return $this;
    }
}
