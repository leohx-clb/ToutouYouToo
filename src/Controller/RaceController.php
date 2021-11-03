<?php

namespace App\Controller;

use App\Entity\Race;
use App\Form\RaceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaceController extends AbstractController
{
    /**
     * @Route("/race", name="race")
     * @Route("/race/{id}/edit", name="edit_race")
     */
    public function index(Request $request, EntityManagerInterface $em, ?Race $race=null): Response
    {
        if (!$race){
            $race = new Race();
        }


        $form = $this->createForm(RaceType::class, $race,[
            'submit' => true
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($race);
            $em->flush();

            return $this->redirectToRoute('race');
        }
        return $this->render('race/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
