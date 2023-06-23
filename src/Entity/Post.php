<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Gedmo\Translatable\Translatable;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post implements Translatable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['sound:playlist:all'])]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $pricing = null;

    #[ORM\Column]
    private ?bool $share = null;

    #[Gedmo\Translatable]
    #[ORM\Column(length: 255)]
    #[Groups(['sound:playlist:all'])]
    private ?string $titre = null;

    #[Gedmo\Translatable]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $corps = null;

    #[Gedmo\Translatable]
    #[ORM\Column(length: 255)]
    #[Groups(['sound:playlist:all'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sound:playlist:all'])]
    private ?string $keywords = null;

    #[ORM\Column]
    #[Groups(['sound:playlist:all'])]
    private ?\DateTimeImmutable $publishAt = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['sound:playlist:all'])]
    private ?Format $format = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'posts')]
    #[Groups(['sound:playlist:all'])]
    private Collection $categorie;

    #[ORM\OneToMany(mappedBy: 'fk_post', targetEntity: Media::class, orphanRemoval: true)]
    #[Groups(['sound:playlist:all'])]
    private Collection $media;

    #[ORM\Column(length: 70)]
    #[Groups(['sound:playlist:all'])]
    private ?string $theme = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    // /**
    //  * Used locale to override Translation listener`s locale
    //  * this is not a mapped field of entity metadata, just a simple property
    //  */
    #[Gedmo\Locale]
    private $locale;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPricing(): ?bool
    {
        return $this->pricing;
    }

    public function setPricing(bool $pricing): self
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function isShare(): ?bool
    {
        return $this->share;
    }

    public function setShare(bool $share): self
    {
        $this->share = $share;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCorps(): ?string
    {
        return $this->corps;
    }

    public function setCorps(string $corps): self
    {
        $this->corps = $corps;

        return $this;
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

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getPublishAt(): ?\DateTimeImmutable
    {
        return $this->publishAt;
    }

    public function setPublishAt(\DateTimeImmutable $publishAt): self
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    public function getFormat(): ?Format
    {
        return $this->format;
    }

    public function setFormat(?Format $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->setFkPost($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getFkPost() === $this) {
                $medium->setFkPost(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}
