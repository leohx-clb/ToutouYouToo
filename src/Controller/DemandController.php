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
     * @Route("/demand/{id}", name="demand")
     */
    public function index(Request $request, EntityManagerInterface $em, AdRepository $adRepository,  int $id): Response
    {
        /** @var Adopting $adopting */
        $adopting = $this->getUser();
        $ad = $adRepository->find($id);
        $demand = new Demand();
        $demand->setAd($ad);
        $demand->setAdopting($adopting);
        $demand->setDateDemand(new DateTime());
        $message = new Message();
        $message->setDateMessage(new DateTime());
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
