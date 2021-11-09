<?php

namespace App\Controller;

use App\Entity\Adopting;
use App\Form\AdoptingComplementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdoptingComplementController extends AbstractController
{
    /**
     * @Route("/adopting/complement", name="adopting_complement")
     */
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        /** @var Adopting $adopting */
        $adopting = $this->getUser();
        $form = $this->createForm(AdoptingComplementType::class, $adopting, [
            'submit' => true,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($adopting);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('adopting_complement/index.html.twig', [
            'controller_name' => 'AdoptingComplementController',
            'form' => $form->createView(),
        ]);
    }
}
