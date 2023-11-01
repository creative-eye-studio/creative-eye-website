<?php

namespace App\Services;

use App\Entity\GlobalSettings;
use App\Entity\Menu;
use App\Entity\PagesList;
use App\Entity\PostsList;
use App\Form\ContactFormType;
use App\Form\PagesAdminFormType;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Locales;

class PagesService extends AbstractController{

    private $em;
    private $settings;
    private $menus;
    private $pages_repo;
    private $posts_repo;
    private $posts_services;

    function __construct(ManagerRegistry $doctrine, PostsService $posts_services){
        $this->em = $doctrine->getManager();
        $this->settings = $doctrine->getRepository(GlobalSettings::class)->findOneBy(['id' => 0]);
        $this->pages_repo = $doctrine->getRepository(PagesList::class);
        $this->posts_repo = $doctrine->getRepository(PostsList::class);
        $this->menus = $doctrine->getRepository(Menu::class);
        $this->posts_services = $posts_services;
    }

    #region Affichage d'une page
    public function getPage(Request $request, string $page_id)
    {
        $page = $this->pages_repo->findOneBy(['page_url' => $page_id]);
        $contact_form = $this->contactForm($request);
        $lang = $this->lang_web($request);

        if (!$page || !$page->isStatus()) {
            return (!$page) ? $this->redirectToRoute('web_index') : throw $this->createNotFoundException("Cette page n'est pas disponible");
        }

        return $this->render('web_pages_views/index.html.twig', [
            'page_content' => htmlspecialchars_decode($page->getPageContent()[$lang]),
            'lang' => $lang,
            'lang_page' => $this->locales_web()[$lang],
            'meta_title' => $page->getPageMetaTitle()[$lang],
            'meta_desc' => $page->getPageMetaDesc()[$lang],
            'last_posts' => $this->posts_services->getLastPosts(),
            'posts' => $this->posts_services->getAllPosts(),
            'settings' => $this->settings,
            'menus' => $this->menus,
            'contact_form' => $contact_form->createView()
        ]);
    }
    #endregion

    #region Affichage d'un post
    public function getPost(Request $request, string $post_id)
    {
        $post = $this->posts_repo->findOneBy(['post_url' => $post_id]);
        $contact_form = $this->contactForm($request);
        $lang = $this->lang_web($request);
        $locales = $this->locales_web();

        if (!$post || !$post->isOnline()) {
            throw $this->createNotFoundException("Cet article n'est pas disponible");
        }

        return $this->render('web_pages_views/post.html.twig', [
            'post_slug' => $post->getPostUrl(),
            'post_thumb' => $post->getPostThumb(),
            'post_content' => htmlspecialchars_decode($post->getPostContent()[array_search($lang, $locales)]),
            'settings' => $this->settings,
            'menus' => $this->menus,
            'lang' => $this->lang_web($request),
            'lang_page' => $this->locales_web()[$lang],
            'meta_title' => $post->getPostMetaTitle()[array_search($lang, $locales)],
            'meta_desc' => $post->getPostMetaDesc()[array_search($lang, $locales)],
            'contact_form' => $contact_form->createView()
        ]);
    }
    #endregion

    #region Private Formulaire de contact
    function contactForm(Request $request){
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
        }

        return $form;
    }
    #endregion

    #region Private Sélection de la langue
    private function locales_web()
    {
        $locales = Locales::getLocales();
        $localesSite = [
            $locales[280], // FR
            $locales[96] // EN
        ];
        return $localesSite;
    }

    private function lang_web(Request $request) 
    {
        $lang = $request->getLocale();
        $localesSite = $this->locales_web();
        $lang = array_search($lang, $localesSite);
        return $lang;
    }
    #endregion  

    #region Page Manager
    function PageManager(Request $request, bool $newPage, string $page_id = null)
    {
        // CREATION / RECUPERATION D'UNE PAGE
        // --------------------------------------------------------
        if ($newPage) {
            $page = new PagesList();
        } else {
            $page = $this->pages_repo->findOneBy(['page_id' => $page_id]);
            if (!$page) {
                throw $this->createNotFoundException("Aucune page n'a été trouvée");
            }
        }

        // INITIALISATION DU FORMULAIRE
        // --------------------------------------------------------
        $form = $this->createForm(PagesAdminFormType::class, $page);
        $form->handleRequest($request);

        // ENVOI DU FORMULAIRE
        // --------------------------------------------------------
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données du formulaire
            $page = $form->getData();

            // Création du nom
            $name = [$form->get('page_name_fr')->getData()];
            $page->setPageName($name);

            // Création du slug
            $slugify = new Slugify();
            $slugName = $slugify->slugify($name[0]);
            $slugUrl = $form->get('page_url')->getData() ? $slugify->slugify($form->get('page_url')->getData()) : "";

            // Création de l'ID Page
            if ($newPage) {
                $page->setPageId($slugName);
            }

            // Création / Modification de l'URL
            $page->setPageUrl(empty($form->get('page_url')->getData()) ? ($newPage ? $slugName : $page->getPageUrl()) : $slugUrl);

            // Création / Modification du Meta Title
            $metaTitle = [$form->get('page_meta_title_fr')->getData() ?: $name[0]];
            $page->setPageMetaTitle($metaTitle);

            // Création / Modification du Meta Desc
            $metaDesc = [$form->get('page_meta_desc_fr')->getData() ?: ''];
            $page->setPageMetaDesc($metaDesc);

            // Création / Modification du contenu
            $pageContent = [htmlspecialchars($form->get('page_content_fr')->getData()) ?: "Contenu à ajouter"];
            $page->setPageContent($pageContent);

            // Envoi des données vers la BDD
            $this->em->persist($page);
            $this->em->flush();
        }

        return $form;
    }
    #endregion


}