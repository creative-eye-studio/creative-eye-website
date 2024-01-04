<?php

namespace App\Entity;

use App\Repository\ExtServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExtServicesRepository::class)]
class ExtServices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $titre = [];

    #[ORM\Column]
    private array $sous_titre = [];

    #[ORM\Column]
    private array $intro = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumb = null;

    #[ORM\Column]
    private array $contenu = [];

    #[ORM\Column]
    private array $services = [];

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\OneToMany(mappedBy: 'ext_service', targetEntity: MenuLink::class)]
    private Collection $menuLinks;

    #[ORM\ManyToOne(inversedBy: 'extServices')]
    private ?Categories $categorie = null;

    public function __construct()
    {
        $this->menuLinks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): array
    {
        return $this->titre;
    }

    public function setTitre(array $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSousTitre(): array
    {
        return $this->sous_titre;
    }

    public function setSousTitre(array $sous_titre): static
    {
        $this->sous_titre = $sous_titre;

        return $this;
    }

    public function getIntro(): array
    {
        return $this->intro;
    }

    public function setIntro(array $intro): static
    {
        $this->intro = $intro;

        return $this;
    }

    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    public function setThumb(string $thumb): static
    {
        $this->thumb = $thumb;

        return $this;
    }

    public function getContenu(): array
    {
        return $this->contenu;
    }

    public function setContenu(array $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getServices(): array
    {
        return $this->services;
    }

    public function setServices(array $services): static
    {
        $this->services = $services;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection<int, MenuLink>
     */
    public function getMenuLinks(): Collection
    {
        return $this->menuLinks;
    }

    public function addMenuLink(MenuLink $menuLink): static
    {
        if (!$this->menuLinks->contains($menuLink)) {
            $this->menuLinks->add($menuLink);
            $menuLink->setExtService($this);
        }

        return $this;
    }

    public function removeMenuLink(MenuLink $menuLink): static
    {
        if ($this->menuLinks->removeElement($menuLink)) {
            // set the owning side to null (unless already changed)
            if ($menuLink->getExtService() === $this) {
                $menuLink->setExtService(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
