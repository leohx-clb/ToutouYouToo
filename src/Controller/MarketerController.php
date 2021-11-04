<?php

namespace App\Controller;

use App\Entity\Marketer;
use App\Form\AdType;
use App\Form\MarketerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class MarketerController extends AbstractController
{
    /**
     * @Route("/marketer", name="marketer")
     */
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $mk = new Marketer();

        $form = $this->createForm(MarketerType::class, $mk, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mk->setIsAdministrator(false);
            $pwd = $hasher->hashPassword($mk, $mk->getPassword());
            $mk->setpassword($pwd);
            $em->persist($mk);
            $em->flush();

            return $this->redirectToRoute('/home');
        }

        return $this->render('marketer/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
