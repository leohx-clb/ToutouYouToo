<?php

namespace App\Controller;

use App\Entity\TypeMarketer;
use App\Form\TypeMarketerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeMarketerController extends AbstractController
{
    /**
     * @Route("/type/marketer", name="type_marketer")
     */
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $typeMarketer = new TypeMarketer();
        $form = $this->createForm(TypeMarketerType::class, $typeMarketer,[
            'submit' => true
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($typeMarketer);
            $em->flush();

            return $this->redirectToRoute('type_marketer');
        }
        return $this->render('type_marketer/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
