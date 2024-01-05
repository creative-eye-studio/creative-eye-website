<?php

namespace App\Entity;

use App\Repository\ExtPartenairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExtPartenairesRepository::class)]
class ExtPartenaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $societe = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column]
    private array $texte = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    #[ORM\ManyToMany(targetEntity: ExtRealisations::class, mappedBy: 'partenaires')]
    private Collection $extRealisations;

    public function __construct()
    {
        $this->extRealisations = new ArrayCollection();
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

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(string $societe): static
    {
        $this->societe = $societe;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTexte(): array
    {
        return $this->texte;
    }

    public function setTexte(array $texte): static
    {
        $this->texte = $texte;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection<int, ExtRealisations>
     */
    public function getExtRealisations(): Collection
    {
        return $this->extRealisations;
    }

    public function addExtRealisation(ExtRealisations $extRealisation): static
    {
        if (!$this->extRealisations->contains($extRealisation)) {
            $this->extRealisations->add($extRealisation);
            $extRealisation->addPartenaire($this);
        }

        return $this;
    }

    public function removeExtRealisation(ExtRealisations $extRealisation): static
    {
        if ($this->extRealisations->removeElement($extRealisation)) {
            $extRealisation->removePartenaire($this);
        }

        return $this;
    }
}
