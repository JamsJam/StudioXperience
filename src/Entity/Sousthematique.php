<?php

namespace App\Entity;

use App\Repository\SousthematiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousthematiqueRepository::class)]
class Sousthematique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sousTheme = null;

    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'sousThematiques')]
    private Collection $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSousTheme(): ?string
    {
        return $this->sousTheme;
    }

    public function setSousTheme(string $sousTheme): static
    {
        $this->sousTheme = $sousTheme;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->addSousThematique($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            $post->removeSousThematique($this);
        }

        return $this;
    }
}
