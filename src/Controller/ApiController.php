<?php

namespace App\Controller;

use App\Services\PostsService;
use App\Services\ExtPartenairesService;
use App\Services\ExtRealisationsService;
use App\Services\ExtServService;
use App\Services\FormsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $postsService;
    private $partnersService;
    private $realsService;
    private $servService;
    private $formService;
    private $request;

    function __construct(
        PostsService $postsService, 
        ExtPartenairesService $partnersService, 
        ExtRealisationsService $realsService, 
        FormsService $formService,
        ExtServService $servService,
    )
    {
        $this->postsService = $postsService;
        $this->partnersService = $partnersService;
        $this->realsService = $realsService;
        $this->servService = $servService;
        $this->formService = $formService;
        $this->request = new Request();
    }

    #[Route('/api/posts', name: 'api_posts')]
    public function posts(): JsonResponse
    {
        return $this->json($this->postsService->getAllPosts(), 200);
    }

    #[Route('/api/lasts-posts', name: 'api_lasts_posts')]
    public function lastPosts(): JsonResponse
    {
        return $this->json($this->postsService->getLastPosts(), 200);
    }

    #[Route('/api/posts-service/{servId}', name: 'api_posts_service')]
    public function servicePosts(int $servId): JsonResponse
    {
        return $this->json($this->postsService->getServicesPosts($servId), 200);
    }

    #[Route('/api/partners', name: 'api_partners')]
    public function partners(): JsonResponse
    {
        return $this->json($this->partnersService->getPartners(), 200);
    }

    #[Route('/api/last-real', name: 'api_last_real')]
    public function lastReal(): JsonResponse
    {
        return $this->json($this->realsService->getLastReal(), 200);
    }

    #[Route('/api/reals', name: 'api_reals')]
    public function reals(): JsonResponse
    {
        return $this->json($this->realsService->getReals(), 200);
    }

    #[Route('/api/services', name: 'api_services')]
    public function services(): JsonResponse
    {
        return $this->json($this->servService->getServices(), 200);
    }

    #[Route(path: '/contact-form', name: 'contact_form', methods: ['POST'])]
    public function contactForm(): JsonResponse
    {
        $data = json_decode($this->request->getContent());

        $contactDatas = [
            'nom' => $data->nom,
            'prenom' => $data->prenom,
            'societe' => $data->societe,
            'fonction' => $data->fonction,
            'secteur' => $data->secteur,
            'particulier' => $data->particulier,
            'codepostal' => $data->codepostal,
            'ville' => $data->ville,
            'telephone' => $data->telephone,
            'mail' => $data->mail,
            'besoins' => $data->besoins,
            'message' => $data->message,
        ];

        $this->formService->send(
            $data->mail,
            'contact@creative-eye.fr',
            "Demande de devis en ligne",
            'contact',
            $contactDatas
        );

        return $this->json($contactDatas);
    }
}
