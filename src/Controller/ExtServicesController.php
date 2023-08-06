<?php

namespace App\Controller;

use App\Entity\ExtServices;
use App\Form\ExtServicesType;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtServicesController extends AbstractController
{
    public function initPage(ManagerRegistry $doctrine, Request $request, string $title, string $serv_id = null) {
        
        $em = $doctrine->getManager();
        $services_ent = $em->getRepository(ExtServices::class);
        $services = $services_ent->findAll();

        $route_name = $request->attributes->get('_route');

        if ($route_name == 'ext_services_update') {
            $service = $services_ent->findOneBy(['id' => $serv_id]);
            $serv_list = implode(',', $service->getServices());
            $serv_list = str_replace(',', '; ', $serv_list);
        } else {
            $service = new ExtServices();
            $serv_list = '';
        }

        $form = $this->createForm(ExtServicesType::class, $service);
        $form->handleRequest($request);

        $contenu = $service->getContenu();
        $intro = $service->getIntro();
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $slugify = new Slugify();
            // Récupération des données du formulaire
            $service = $form->getData();
            
            // Titre
            $titre = [$form->get('titre')->getData()];
            $service->setTitre($titre);

            // Sous-Titre
            $sous_titre = [$form->get('sous_titre')->getData()];
            $service->setSousTitre($sous_titre);

            // Thumb
            $thumb = $form->get('thumb')->getData();
            if ($thumb != null) {
                $originalFileName = pathinfo($thumb->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugify->slugify($originalFileName);
                $newFileName = $safeFileName . '.' . $thumb->guessExtension();
                try {
                    $thumb->move(
                        '/uploads/images/services',
                        $newFileName
                    );
                    $service->setThumb($newFileName);
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                $file = $service->getThumb();
                $service->setThumb($file);
            }

            // Intro
            $intro = [htmlspecialchars($form->get('intro')->getData())];
            $service->setIntro($intro);

            // Contenu
            $contenu = [htmlspecialchars($form->get('contenu')->getData())];
            $service->setContenu($contenu);

            // Services
            $serviceList = explode('; ', $form->get('services')->getData());
            $service->setServices($serviceList);

            // URL
            $slug = $slugify->slugify($titre[0]);
            if ($route_name != 'ext_services_update'){
                $service->setUrl($slug);
            }

            // Envoi des données vers la BDD
            $em->persist($service);
            $em->flush();
        }

        return $this->render('ext_services/index.html.twig', [
            'route' => $route_name,
            'title' => $title,
            'services' => $services,
            'form' => $form,
            'ftitre' => $service->getTitre(),
            'fsous_titre' => $service->getSousTitre(),
            'fthumb' => $service->getThumb(),
            'fservices' => $serv_list,
            'fintro_fr' => $intro ? htmlspecialchars_decode($intro[0]) : '',
            'fcontenu_fr' => $contenu ? htmlspecialchars_decode($contenu[0]) : ''
        ]);
    }

    #[Route('/ext/services', name: 'ext_services')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $initPage = $this->initPage($doctrine, $request, 'Liste des services');
        return $initPage;
    }

    #[Route('/ext/services/ajouter', name: 'ext_services_add')]
    public function addMenu(ManagerRegistry $doctrine, Request $request)
    {
        $initPage = $this->initPage($doctrine, $request, 'Créer un nouveau service');
        return $initPage;
    }

    #[Route('/ext/services/modifier/{serv_id}', name: 'ext_services_update')]
    public function updateMenu(ManagerRegistry $doctrine, Request $request, int $serv_id)
    {
        $initPage = $this->initPage($doctrine, $request, 'Modifier un service', $serv_id);
        return $initPage;
    }
}
