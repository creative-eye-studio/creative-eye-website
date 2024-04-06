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

        $mj = new \Mailjet\Client($apiKey, $apiSecret, true, ['version' => 'v3.1']);
        $email = $data->email;
        $listId = '10046985';

        $body = [
            'IsUnsubscribed' => false,
            'Email' => $email
        ];

        $response = $mj->post(Resources::$Contact, ['body' => $body]);

        if ($response->success()) {
            $contactId = $response->getData()['0']['ID'];
            $response = $mj->post(Resources::$Listrecipient, ['body' => ['ContactID' => $contactId, 'ListID' => $listId]]);

            if ($response->success()) {
                $status = "Adresse e-mail ajoutée avec succès à la liste Mailjet.";
            } else {
                $status = "Une erreur est survenue lors de l'ajout de l'adresse E-Mail : " . $response->getReasonPhrase();
            }
        } else {
            $status = "Une erreur est survenue lors de la création du contact : " . $response->getReasonPhrase();
        }
        
        return $this->json([
            'message' => $status,
        ]);
    }
}
