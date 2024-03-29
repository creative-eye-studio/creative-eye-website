<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Services\PagesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebPagesIndexController extends AbstractController
{
    private $pages_services;

    public function __construct(PagesService $pages_services)
    {
        $this->pages_services = $pages_services;
    }


    // Index Page
    // -------------------------------------------------------------------------------------------
    #[Route('/{_locale}', name: 'web_index', requirements: ['_locale' => LocaleConstraint::LOCALE_PATTERN])]
    public function index(): Response
    {
        return $this->pages_services->getPageStatus();
    }


    // Service Page
    // -------------------------------------------------------------------------------------------
    #[Route('/{_locale}/expertise/{service_slug}', name: 'web_service', requirements: ['_locale' => LocaleConstraint::LOCALE_PATTERN])]
    public function service(string $service_slug): Response
    {
        return $this->pages_services->getServiceStatus($service_slug);
    }


    // Real Page
    // -------------------------------------------------------------------------------------------
    #[Route('/{_locale}/realisation/{real_slug}', name: 'web_real', requirements: ['_locale' => LocaleConstraint::LOCALE_PATTERN])]
    public function real(string $real_slug)
    {
        return $this->pages_services->getRealStatus($real_slug);
    }


    // Other Page
    // -------------------------------------------------------------------------------------------
    #[Route('/{_locale}/{page_slug}', name: 'web_page', requirements: ['_locale' => LocaleConstraint::LOCALE_PATTERN])]
    public function page(string $page_slug): Response
    {
        return $this->pages_services->getPageStatus($page_slug);
    }


    // Post Page
    // -------------------------------------------------------------------------------------------
    #[Route('/{_locale}/blog/{post_slug}', name: 'web_post', requirements: ['_locale' => LocaleConstraint::LOCALE_PATTERN])]
    public function post(string $post_slug): Response
    {
        return $this->pages_services->getPost($post_slug);
    }


    // Redirections
    // -------------------------------------------------------------------------------------------
    #[Route('/', name: 'web_redirect')]
    public function redirectBase(){
        return $this->redirectToRoute('web_index');
    }
}

class LocaleConstraint
{
    const LOCALE_PATTERN = 'fr|en';
}
