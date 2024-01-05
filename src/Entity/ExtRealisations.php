<?php

namespace App\Entity;

use App\Repository\ExtRealisationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExtRealisationsRepository::class)]
class ExtRealisations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    #[ORM\Column]
    private array $intro = [];

    #[ORM\ManyToMany(targetEntity: ExtServices::class, inversedBy: 'extRealisations')]
    private Collection $services;

    #[ORM\ManyToMany(targetEntity: ExtPartenaires::class, inversedBy: 'extRealisations')]
    private Collection $partenaires;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $annee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $youtube = null;

    #[ORM\Column]
    private array $demande = [];

    #[ORM\Column(nullable: true)]
    private ?array $approche = null;

    #[ORM\OneToMany(mappedBy: 'extRealisations', targetEntity: ExtRealisationsImages::class)]
    private Collection $images;

    #[ORM\Column(length: 255)]
    private ?string $main_image = null;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->partenaires = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

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

    /**
     * @return Collection<int, ExtServices>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(ExtServices $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
        }

        return $this;
    }

    public function removeService(ExtServices $service): static
    {
        $this->services->removeElement($service);

        return $this;
    }

    /**
     * @return Collection<int, ExtPartenaires>
     */
    public function getPartenaires(): Collection
    {
        return $this->partenaires;
    }

    public function addPartenaire(ExtPartenaires $partenaire): static
    {
        if (!$this->partenaires->contains($partenaire)) {
            $this->partenaires->add($partenaire);
        }

        return $this;
    }

    public function removePartenaire(ExtPartenaires $partenaire): static
    {
        $this->partenaires->removeElement($partenaire);

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): static
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getDemande(): array
    {
        return $this->demande;
    }

    public function setDemande(array $demande): static
    {
        $this->demande = $demande;

        return $this;
    }

    public function getApproche(): ?array
    {
        return $this->approche;
    }

    public function setApproche(?array $approche): static
    {
        $this->approche = $approche;

        return $this;
    }

    /**
     * @return Collection<int, ExtRealisationsImages>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ExtRealisationsImages $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setExtRealisations($this);
        }

        return $this;
    }

    public function removeImage(ExtRealisationsImages $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getExtRealisations() === $this) {
                $image->setExtRealisations(null);
            }
        }

        return $this;
    }

    public function getMainImage(): ?string
    {
        return $this->main_image;
    }

    public function setMainImage(string $main_image): static
    {
        $this->main_image = $main_image;

        return $this;
    }
}
