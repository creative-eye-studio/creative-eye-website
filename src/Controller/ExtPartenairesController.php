<?php

namespace App\Controller;

use App\Entity\ExtPartenaires;
use App\Form\ExtPartenairesType;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtPartenairesController extends AbstractController
{
    private $em;
    private $request;

    function __construct(EntityManagerInterface $em, RequestStack $request)
    {
        $this->em = $em;
        $this->request = $request->getCurrentRequest();
    }

    #[Route('/ext/partenaires', name: 'app_ext_partenaires')]
    public function index(): Response
    {
        return $this->initPage("Liste des partenaires");
    }

    #[Route('/ext/partenaires/ajouter', name: 'app_ext_partenaires_add')]
    public function addPartner(): Response
    {
        return $this->initPage("Ajouter un partenaire");
    }

    #[Route('/ext/partenaires/modifier/{data_id}', name: 'app_ext_partenaires_update')]
    public function updatePartner(int $data_id): Response
    {
        return $this->initPage("Modifier un partenaire", $data_id);
    }

    #[Route('/ext/partenaires/suppr/{data_id}', name: 'app_ext_partenaires_delete')]
    public function deletePartner(int $data_id)
    {
        $partner = $this->em->getRepository(ExtPartenaires::class)->find($data_id);

        // Envoi des données vers la BDD
        $this->em->remove($partner);
        $this->em->flush();
        
        return $this->redirectToRoute('app_ext_partenaires');
    }
    
    private function initPage(string $titrePage, int $data_id = null)
    {
        $route_name = $this->request->attributes->get('_route');

        $db = $this->em->getRepository(ExtPartenaires::class);
        $partners = $db->findAll();

        $data = ($route_name == 'app_ext_partenaires' || $route_name == 'app_ext_partenaires_add') 
            ? new ExtPartenaires() 
            : $db->find($data_id);


        $textFr = ($data->getTexte() != null) ? htmlspecialchars_decode($data->getTexte()[0]) : '';

        $form = $this->createForm(ExtPartenairesType::class, $data);
        $form->handleRequest($this->request);
        
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
            $this->em->persist($data);
            $this->em->flush();

            return $this->redirect($this->request->getUri());
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
}
