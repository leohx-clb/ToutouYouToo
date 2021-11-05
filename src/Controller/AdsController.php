<?php

namespace App\Controller;

use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdsController extends AbstractController
{
    private AdRepository  $adRepository;
    /**
     * @Route("/ads", name="ads")
     */
    public function index(AdRepository $adRepository): Response
    {
        $this->adRepository = $adRepository;

        $ads = $adRepository->findAll();

        return $this->render('ads/index.html.twig', [
            'controller_name' => 'AdsController',
            'ads' => $ads,
        ]);
    }
}
