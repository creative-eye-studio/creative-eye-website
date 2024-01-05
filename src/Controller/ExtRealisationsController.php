<?php

namespace App\Controller;

use App\Entity\ExtRealisations;
use App\Form\ExtRealisationsType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ExtRealisationsController extends AbstractController
{
    private $em;
    private $request;
    private $slugger;

    function __construct(EntityManagerInterface $em, RequestStack $request, SluggerInterface $slugger)
    {
        $this->em = $em;
        $this->request = $request->getCurrentRequest();
        $this->slugger = $slugger;
    }

    #[Route('/ext/realisations', name: 'ext_realisations')]
    public function index(): Response
    {
        $reals = $this->em->getRepository(ExtRealisations::class)->findAll();

        return $this->render('ext_realisations/index.html.twig', [
            'reals' => $reals
        ]);
    }

    #[Route('/ext/realisations/ajouter', name: 'ext_realisations_add')]
    #[Route('/ext/realisations/modifier/{id}', name: 'ext_realisations_update')]
    public function realManager(int $id = null): Response
    {

        // Action d'ajout ou de modification
        if ($id != null) {
            $title = "Modifier une réalisation";
            $real = $this->em->getRepository(ExtRealisations::class)->find($id);
        } else {
            $title = "Ajouter une réalisation";
            $real = new ExtRealisations;
        }


        // Création du formulaire
        $form = $this->createForm(ExtRealisationsType::class, $real);
        $form->handleRequest($this->request);
        

        // Soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) { 
            $formData = $form->getData();

            // Sauvegarde de l'image
            $imageData = $form->get('main_image')->getData();
            if ($imageData) {
                $fileName = pathinfo($imageData->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $this->slugger->slug($fileName);
                $newFilename = $safeFileName . '-' . uniqid() . '.' . $imageData->guessExtension();
                try {
                    $imageData->move(
                        $this->getParameter('reals_mainimg_directory'),
                        $newFilename
                    );
                    $real->setMainImage($newFilename);
                } catch (FileException $e) {
                    throw new Exception($e, 1);
                }
            }
            // Sauvegarde de l'introduction
            $real->setIntro([
                htmlspecialchars($form->get('intro')->getData())
            ]);
            // Sauvegarde de la demande
            $real->setDemande([
                htmlspecialchars($form->get('demande')->getData())
            ]);
            // Sauvegarde de l'approche
            $real->setApproche([
                htmlspecialchars($form->get('approche')->getData())
            ]);

            $this->em->persist($real);
            $this->em->flush();

            return $this->redirectToRoute('ext_realisations_update', [
                'id' => $real->getId()
            ]);
        }

        return $this->render('ext_realisations/form-manager.html.twig', [
            'title' => $title,
            'form' => $form->createView(),
            'intro' => htmlspecialchars_decode($real->getIntro()[0] ?? ""),
            'demande' => htmlspecialchars_decode($real->getDemande()[0] ?? ""),
            'approche' => htmlspecialchars_decode($real->getApproche()[0] ?? ""),
        ]);
    }

    #[Route('/ext/realisations/suppr/{id}', name: 'ext_realisations_delete')]
    public function deleteReal(int $id)
    {
        $real = $this->em->getRepository(ExtRealisations::class)->find($id);
        $this->em->remove($real);
        $this->em->flush();

        return $this->redirectToRoute('ext_realisations');
    }

}
