<?php

namespace App\Services;

use App\Entity\ExtRealisations;
use Doctrine\ORM\EntityManagerInterface;

class ExtRealisationsService
{
    private $em;
    private $reals_repo;

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->reals_repo = $this->em->getRepository(ExtRealisations::class);
    }

    public function getReals()
    {
        $reals = $this->reals_repo->findBy([], ['id' => 'DESC']);

        return array_map(function($real) {

            $servicesList = array_map(function($service) {
                return [
                    'nom' => $service->getTitre(),
                ];
            }, $real->getServices()->toArray());

            return [
                'id' => $real->getId(),
                'nom' => $real->getNom(),
                'thumb' => $real->getMainImage(),
                'url' => $real->getUrl(),
                'services' => $servicesList,
            ];
        }, $reals);
    }

    public function getLastReal() 
    {
        $lastReal = $this->reals_repo->findOneBy([], ['id' => 'DESC']);

        $servicesList = array_map(function($service) {
            return [
                'nom' => $service->getTitre(),
            ];
        }, $lastReal->getServices()->toArray());

        return [
            'id' => $lastReal->getId(),
            'nom' => $lastReal->getNom(),
            'thumb' => $lastReal->getMainImage(),
            'url' => $lastReal->getUrl(),
            'services' => $servicesList,
        ];
    }
}
