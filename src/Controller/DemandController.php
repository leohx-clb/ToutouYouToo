<?php

namespace App\Controller;

use App\Entity\Adopting;
use App\Entity\Demand;
use App\Entity\Message;
use App\Form\AdoptingComplementType;
use App\Form\DemandType;
use App\Repository\AdRepository;
use Cassandra\Date;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandController extends AbstractController
{
    /**
     * @Route("/demand", name="demand")
     */
    public function index(Request $request, EntityManagerInterface $em, AdRepository $adRepository): Response
    {
        /** @var Adopting $adopting */
        $adopting = $this->getUser();
        $id = 14;
        $ad = $adRepository->find($id);
        $demand = new Demand();
        $demand->setAd($ad);
        $demand->setDateDemand(new DateTime());
        $message = new Message();
        $demand->addMessage($message);

        $form = $this->createForm(DemandType::class, $demand, [
            'submit' => true,
            'ad' => $ad,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($demand);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('demand/index.html.twig', [
            'controller_name' => 'DemandController',
            'form' => $form->createView(),
        ]);
    }
}
