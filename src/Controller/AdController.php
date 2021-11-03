<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Dog;
use App\Entity\Marketer;
use App\Form\AdType;
use Cassandra\Date;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdController extends AbstractController
{
    /**
     @Route("/ad", name="ad")
     *
     */
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $ad = new Ad();
        $form = $this->createForm(AdType::class, $ad, [
            'method' => 'POST',
        ]);

        /** @var Marketer $marketer */
        $marketer = $this->getUser();
        $ad->setMarketer($marketer);

        $currentDate = new DateTime();
        $ad->setDateUpdate($currentDate);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ad);
            $em->flush();

            return $this->redirectToRoute('/home');
        }

        return $this->render('ad/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
