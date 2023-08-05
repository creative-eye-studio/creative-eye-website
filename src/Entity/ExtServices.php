<?php

namespace App\Entity;

use App\Repository\ExtServicesRepository;
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
}
