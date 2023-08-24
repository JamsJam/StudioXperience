<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?thematique $thematique = null;

    #[ORM\ManyToMany(targetEntity: Sousthematique::class, inversedBy: 'posts')]
    private Collection $sousThematiques;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $publishAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $editAt = null;

    #[ORM\Column(nullable: true)]
    private ?array $content = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    public function __construct()
    {
        $this->sousThematiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThematique(): ?thematique
    {
        return $this->thematique;
    }

    public function setThematique(?thematique $thematique): static
    {
        $this->thematique = $thematique;

        return $this;
    }

    /**
     * @return Collection<int, Sousthematique>
     */
    public function getSousThematiques(): Collection
    {
        return $this->sousThematiques;
    }

    public function addSousThematique(Sousthematique $sousThematique): static
    {
        if (!$this->sousThematiques->contains($sousThematique)) {
            $this->sousThematiques->add($sousThematique);
        }

        return $this;
    }

    public function removeSousThematique(Sousthematique $sousThematique): static
    {
        $this->sousThematiques->removeElement($sousThematique);

        return $this;
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

    public function getPublishAt(): ?\DateTimeImmutable
    {
        return $this->publishAt;
    }

    public function setPublishAt(\DateTimeImmutable $publishAt): static
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    public function getEditAt(): ?\DateTimeImmutable
    {
        return $this->editAt;
    }

    public function setEditAt(\DateTimeImmutable $editAt): static
    {
        $this->editAt = $editAt;

        return $this;
    }

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function setContent(?array $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }
}
