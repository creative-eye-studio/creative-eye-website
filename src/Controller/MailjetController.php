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
        $apiKey = getenv('MJ_APIKEY_PUBLIC');
        $apiSecret = getenv('MJ_APIKEY_PRIVATE');

        $mj = new \Mailjet\Client($apiKey, $apiSecret);
        $email = $data->email;

        $body = [
            'Email' => $email
        ];

        $response = $mj->post(Resources::$Contact, ['body' => $body]);
        
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
            ]);
        }
    }
}
