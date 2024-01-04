<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: ExtServices::class)]
    private Collection $extServices;

    #[ORM\ManyToMany(targetEntity: PostsList::class, mappedBy: 'categories')]
    private Collection $postsLists;

    public function __construct()
    {
        $this->extServices = new ArrayCollection();
        $this->postsLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, ExtServices>
     */
    public function getExtServices(): Collection
    {
        return $this->extServices;
    }

    public function addExtService(ExtServices $extService): static
    {
        if (!$this->extServices->contains($extService)) {
            $this->extServices->add($extService);
            $extService->setCategorie($this);
        }

        return $this;
    }

    public function removeExtService(ExtServices $extService): static
    {
        if ($this->extServices->removeElement($extService)) {
            // set the owning side to null (unless already changed)
            if ($extService->getCategorie() === $this) {
                $extService->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostsList>
     */
    public function getPostsLists(): Collection
    {
        return $this->postsLists;
    }

    public function addPostsList(PostsList $postsList): static
    {
        if (!$this->postsLists->contains($postsList)) {
            $this->postsLists->add($postsList);
            $postsList->addCategory($this);
        }

        return $this;
    }

    public function removePostsList(PostsList $postsList): static
    {
        if ($this->postsLists->removeElement($postsList)) {
            $postsList->removeCategory($this);
        }

        return $this;
    }
}
