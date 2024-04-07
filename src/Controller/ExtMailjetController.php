<?php

namespace App\Controller;

use Mailjet\Resources;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtMailjetController extends AbstractController
{
    #[Route('/admin/ext/mailjet', name: 'app_ext_mailjet')]
    public function index(): Response
    {
        // Initialisation de Mailjet
        $apiKey = $this->getParameter('mailjet_public');
        $apiSecret = $this->getParameter('mailjet_private');
        $mj = new \Mailjet\Client($apiKey, $apiSecret, true, ['version' => 'v3']);
        $listId = "10046985";

        $response = $mj->get(Resources::$Contactslist, ['id' => $listId]);

        return $this->render('ext_mailjet/index.html.twig', [
            'list' => $response->getData(),
            'controller_name' => 'ExtMailjetController',
        ]);
    }
}
