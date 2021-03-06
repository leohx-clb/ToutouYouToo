<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Form\DogType;
use App\Repository\DogRepository;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DogController extends AbstractController
{
    private DogRepository $dogRepository;
    private PictureRepository $pictureRepository;

    /**
     * @Route("/dog", name="new_dog")
     * @Route("/dog/{id}/edit", name="edit_dog")
     */
    public function add(Request $request, EntityManagerInterface $em, ?Dog $dog = null): Response
    // Pour EDITION DOG L17 * @Route("/dog/{id}/edit", name="edit_dog")
    // Pour EDITION DOG L19 ?Dog $dog = null pour check que l'objet peut être modifié
    // Pour EDITION DOG L 24 if (!$dog) {}
    {
        if (!$dog) {
            $dog = new Dog();
        }
        // On crée le formulaire (objet de traitement)
        // Premier paramètre : le formulaire type (FQCN)
        // Deuxième paramètre : l'objet à manipuler (à synchroniser avec le formulaire)
        // Troisième paramètre : des options du formulaire:

        $form = $this->createForm(DogType::class, $dog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dog);
            $em->flush();

            $this->addFlash('success', 'Donnée insérée');

            return $this->redirectToRoute('new_dog');
        }

        return $this->render('dog/add.html.twig', [
            'form' => $form->createView(),
            'dog' => $dog,
        ]);
    }

    /**
     * @Route("/dog/list", name="list_dogs")
     */
    public function list(DogRepository $dogRepository, PictureRepository $pictureRepository): Response
    {
        $this->dogRepository = $dogRepository;
        $dogs = $dogRepository->findAll();
        $this->pictureRepository = $pictureRepository;
        $pictures = $pictureRepository->findAll();

        return $this->render('dog/list.html.twig', [
            'picture' => $pictures,
            'dogs' => $dogs,
        ]);
    }
}
