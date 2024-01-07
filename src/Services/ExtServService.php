<?php

namespace App\Services;

use App\Entity\ExtServices;
use Doctrine\ORM\EntityManagerInterface;

class ExtServService
{
    private $em;
    private $service_repo;

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->service_repo = $this->em->getRepository(ExtServices::class);
    }

    public function getServices()
    {
        return array_map(function($service) {
            return [
                'id' => $service->getId(),
                'titre' => $service->getTitre(),
                'thumb' => $service->getThumb(),
                'intro' => htmlspecialchars_decode($service->getIntro()[0]),
                'url' => $service->getUrl(),
            ];
        }, $this->service_repo->findAll());
    }
}
