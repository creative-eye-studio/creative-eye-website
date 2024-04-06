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
        $response->success();
        
        return $this->json([
            'message' => $response->getData(),
        ]);
    }
}
