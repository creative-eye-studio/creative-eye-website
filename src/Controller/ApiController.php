<?php

namespace App\Controller;

use App\Services\PostsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $postsService;

    function __construct(PostsService $postsService)
    {
        $this->postsService = $postsService;
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
}
