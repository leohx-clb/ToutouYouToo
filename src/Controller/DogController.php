<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Form\DogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DogController extends AbstractController
{
    /**
     * @Route("/dog", name="new_dog")
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $dog =new Dog();
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
        ]);
    }
}
