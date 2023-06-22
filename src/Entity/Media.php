<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MediaRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alt = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sound:playlist:all'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sound:playlist:all'])]
    private ?string $vignette = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sound:playlist:all'])]
    private ?string $src = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sound:playlist:all'])]
    private ?string $extension = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $fk_post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVignette(): ?string
    {
        return $this->vignette;
    }

    public function setVignette(string $vignette): self
    {
        $this->vignette = $vignette;

        return $this;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getFkPost(): ?Post
    {
        return $this->fk_post;
    }

    public function setFkPost(?Post $fk_post): self
    {
        $this->fk_post = $fk_post;

        return $this;
    }
}
