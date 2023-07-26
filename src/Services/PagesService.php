<?php

namespace App\Services;

use App\Entity\PagesList;
use App\Form\PagesAdminFormType;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PagesService extends AbstractController{
    
    function PageManager(ManagerRegistry $doctrine, Request $request, bool $newPage, String $page_id = null)
    {
        $entityManager = $doctrine->getManager();

        // CREATION / RECUPERATION D'UNE PAGE
        // --------------------------------------------------------
        if ($newPage) {
            $page = new PagesList();
        } else {
            $page = $entityManager->getRepository(PagesList::class)->findOneBy(['page_id' => $page_id]);
            if(!$page) {
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

            // Création du slug
            $slugify = new Slugify();
            $slugName = $slugify->slugify($form->get('page_name')->getData());
            $slugUrl = $slugify->slugify($form->get('page_url')->getData());

            // Création de l'ID Page
            if ($newPage) {
                $page->setPageId($slugName);
            }

            // Création de l'URL
            if ($form->get('page_url')->getData()) {
                $page->setPageUrl($slugUrl);
            } else {
                if ($newPage) {
                    $page->setPageUrl($slugName);
                } else {
                    $page->setPageUrl($page->setPageUrl($page->getPageUrl()));
                }
            }

            // Création du Meta Title
            $page->setPageMetaTitle([
                $form->get('page_meta_title')->getData(),
                $form->get('page_meta_title_en')->getData()
            ]);

            // Création du Meta Desc
            $page->setPageMetaDesc([
                $form->get('page_meta_desc')->getData(),
                $form->get('page_meta_desc_en')->getData()
            ]);

            // Création / Modification du contenu
            $pageContent = htmlspecialchars($form->get('page_content')->getData());
            $pageContentEn = htmlspecialchars($form->get('page_content_en')->getData());
            $page->setPageContent([
                $pageContent ? $pageContent : "Contenu à ajouter",
                $pageContentEn ? $pageContentEn : "Content to add"
            ]);

            // Envoi des données vers la BDD
            $entityManager->persist($page);
            $entityManager->flush();
        }

        return $form;
    }
}