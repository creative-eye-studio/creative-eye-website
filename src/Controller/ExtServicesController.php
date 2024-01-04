<?php

namespace App\Controller;

use App\Entity\ExtServices;
use App\Form\ExtServicesType;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtServicesController extends AbstractController
{
    private $em;
    private $request;

    function __construct(EntityManagerInterface $em, RequestStack $request)
    {
        $this->em = $em;
        $this->request = $request->getCurrentRequest();
    }

    private function initPage(string $title, string $serv_id = null) 
    {
        $services_ent = $this->em->getRepository(ExtServices::class);
        $services = $services_ent->findAll();

        $route_name = $this->request->attributes->get('_route');

        $service = ($route_name == 'ext_services_update') 
            ? $services_ent->find($serv_id) 
            : new ExtServices();

        $serv_list = ($route_name == 'ext_services_update') 
            ? str_replace(',', '; ', implode(',', $service->getServices())) 
            : '';


        $form = $this->createForm(ExtServicesType::class, $service);
        $form->handleRequest($this->request);

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
                        'uploads/images/services',
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
            $this->em->persist($service);
            $this->em->flush();

            return $this->redirect($this->request->getUri());
        }

        return $this->render('ext_services/index.html.twig', [
            'route' => $route_name,
            'title' => $title,
            'services' => $services,
            'form' => $form,
            'ftitre' => $service->getTitre(),
            'fsous_titre' => $service->getSousTitre(),
            'fcat' => $service->getCategorie(),
            'fthumb' => $service->getThumb(),
            'fservices' => $serv_list,
            'fintro_fr' => $intro ? htmlspecialchars_decode($intro[0]) : '',
            'fcontenu_fr' => $contenu ? htmlspecialchars_decode($contenu[0]) : ''
        ]);
    }

    #[Route('/ext/services', name: 'ext_services')]
    public function index(): Response
    {
        return $this->initPage('Liste des services');
    }

    #[Route('/ext/services/ajouter', name: 'ext_services_add')]
    public function addService(): Response
    {
        return $this->initPage('Créer un nouveau service');
    }

    #[Route('/ext/services/modifier/{serv_id}', name: 'ext_services_update')]
    public function updateService(int $serv_id): Response
    {
        return $this->initPage('Modifier un service', $serv_id);
    }
}
