<?php

namespace App\Services;

use App\Entity\ExtPartenaires;
use Doctrine\ORM\EntityManagerInterface;

class ExtPartenairesService
{
    private $em;
    private $partners_repo;

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->partners_repo = $this->em->getRepository(ExtPartenaires::class);
    }

    public function getPartners()
    {
        return array_map(function ($partner) {
            return [
                'id' => $partner->getId(),
                'nom' => $partner->getNom(),
                'societe' => $partner->getSociete(),
                'logo' => $partner->getLogo(),
                'photo' => $partner->getPhoto(),
                'website' => $partner->getWebsite(),
                'texte' => htmlspecialchars_decode($partner->getTexte()[0]),
            ];
        }, $this->partners_repo->findAll());
    }
}
