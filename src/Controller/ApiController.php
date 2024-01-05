<?php

namespace App\Controller;

use App\Services\PostsService;
use App\Services\ExtPartenairesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $postsService;
    private $partnersService;

    function __construct(PostsService $postsService, ExtPartenairesService $partnersService)
    {
        $this->postsService = $postsService;
        $this->partnersService = $partnersService;
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
}
