<?php

namespace App\Entity;

use App\Repository\ExtRealisationsImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExtRealisationsImagesRepository::class)]
class ExtRealisationsImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?ExtRealisations $extRealisations = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getExtRealisations(): ?ExtRealisations
    {
        return $this->extRealisations;
    }

    public function setExtRealisations(?ExtRealisations $extRealisations): static
    {
        $this->extRealisations = $extRealisations;

        return $this;
    }
}
