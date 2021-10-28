<?php

namespace App\Controller;

use App\Entity\Adopting;
use App\Form\AdoptingType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdoptingController extends AbstractController
{
    /**
     * @Route("/adopting", name="adopting")
     */
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $adopting = new Adopting();
        $form = $this->createForm(AdoptingType::class, $adopting, [
            'submit' => true
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($adopting);
            $em->flush();

            return $this->redirectToRoute('adopting');
        }


        return $this->render('adopting/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
