<?php

namespace App\Controller;

use App\Entity\ExtPartenaires;
use App\Form\ExtPartenairesType;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtPartenairesController extends AbstractController
{
    
    public function initPage(Request $request, ManagerRegistry $doctrine, string $titrePage, int $data_id = null)
    {
        $route_name = $request->attributes->get('_route');

        $em = $doctrine->getManager();
        $db = $em->getRepository(ExtPartenaires::class);
        $partners = $db->findAll();

        if ($route_name == 'app_ext_partenaires' or $route_name == 'app_ext_partenaires_add') {
            $data = new ExtPartenaires();
        } else {
            $data = $db->findOneBy(['id' => $data_id]);
        }

        $textFr = ($data->getTexte() != null) ? htmlspecialchars_decode($data->getTexte()[0]) : '';

        
        $form = $this->createForm(ExtPartenairesType::class, $data);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $slugify = new Slugify();

            // Récupération des données du formulaire
            $data = $form->getData();

            // Logo
            $logo = $form->get('logo')->getData();
            if ($logo) {
                $originalFileName = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugify->slugify($originalFileName);
                $newFileName = $safeFileName . '.' . $logo->guessExtension();
                try {
                    $logo->move(
                        'uploads/images/partners/logos',
                        $newFileName
                    );
                    $data->setLogo($newFileName);
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                $file = $data->getLogo();
                $data->setLogo($file);
            }

            // Image Gérant
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugify->slugify($originalFileName);
                $newFileName = $safeFileName . '.' . $photo->guessExtension();
                try {
                    $photo->move(
                        'uploads/images/partners/photos',
                        $newFileName
                    );
                    $data->setPhoto($newFileName);
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                $file = $data->getPhoto();
                $data->setPhoto($file);
            }

            // Texte
            $textFr = htmlspecialchars($form->get('texte')->getData());
            $data->setTexte([$textFr]);

            // Envoi des données vers la BDD
            $em->persist($data);
            $em->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('ext_partenaires/index.html.twig', [
            'titre_page' => $titrePage,
            'route' => $route_name,
            'id' => $data_id,
            'partners' => $partners,
            'form' => $form->createView(),
            'textFr' => $textFr
        ]);
    }


    #[Route('/ext/partenaires', name: 'app_ext_partenaires')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $initPage = $this->initPage($request, $doctrine, "Liste des partenaires");
        return $initPage;
    }

    #[Route('/ext/partenaires/ajouter', name: 'app_ext_partenaires_add')]
    public function addPartner(Request $request, ManagerRegistry $doctrine)
    {
        $initPage = $this->initPage($request, $doctrine, "Ajouter un partenaire");
        return $initPage;
    }

    #[Route('/ext/partenaires/modifier/{data_id}', name: 'app_ext_partenaires_update')]
    public function updatePartner(Request $request, ManagerRegistry $doctrine, int $data_id)
    {
        $initPage = $this->initPage($request, $doctrine, "Modifier un partenaire", $data_id);
        return $initPage;
    }

    #[Route('/ext/partenaires/suppr/{data_id}', name: 'app_ext_partenaires_delete')]
    public function deletePartner(Request $request, ManagerRegistry $doctrine, int $data_id)
    {
        $em = $doctrine->getManager();
        $db = $em->getRepository(ExtPartenaires::class);
        $partner = $db->findOneBy(['id' => $data_id]);

        // Envoi des données vers la BDD
        $em->remove($partner);
        $em->flush();
        
        return $this->redirectToRoute('app_ext_partenaires');
    }
}
