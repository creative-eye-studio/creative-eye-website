<?php

namespace App\Controller;

use \Mailjet\Resources;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MailjetController extends AbstractController
{
    #[Route('/mailjet', name: 'app_mailjet')]
    public function index(Request $req): JsonResponse
    {
        $data = json_decode($req->getContent());

        // Initialisation de Mailjet
        $apiKey = $this->getParameter('mailjet_public');
        $apiSecret = $this->getParameter('mailjet_private');

        // Création du contact
        $mj = new \Mailjet\Client($apiKey, $apiSecret);
        $email = $data->email;
        $body = [
            'Email' => $email,
        ];

        $response = $mj->post(Resources::$Contact, ['body' => $body]);

        // Placement du contact dans la liste
        $listId = "10046985";
        $body = [
            'ContactAlt' => $email,
            'ListID' => $listId
        ];

        $response = $mj->post(Resources::$Listrecipient, ['body' => $body]);

        if ($response->success()) {
            return $this->json([
                'success' => true,
                'email' => $email,
                'message' => 'Adresse e-mail ajoutée avec succès à Mailjet.',
            ]);
        } else {
            return $this->json([
                'success' => false,
                'email' => $email,
                'message' => 'Erreur lors de l\'ajout de l\'adresse e-mail à Mailjet : ' . $response->getReasonPhrase(),
                'public' => $apiKey,
                'private' => $apiSecret,
            ]);
        }
    }
}
