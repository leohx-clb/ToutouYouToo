<?php

namespace App\Controller;

use App\Repository\AdRepository;
use App\Repository\DogRepository;
use App\Repository\MarketerRepository;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private MarketerRepository $marketerRepository;
    private AdRepository  $adRepository;

    /**
     * @Route("/", name="home")
     * @param MarketerRepository $marketerRepository
     * @param AdRepository  $adRepository
     * @return Response
     */
    public function index(AdRepository $adRepository,MarketerRepository $marketerRepository): Response
    {
        $this->marketerRepository = $marketerRepository;
        $marketers = $marketerRepository->findAll();
        $this->adRepository = $adRepository;
//        $adsDesc = $adRepository->findBy(['dateUpdate' => 'ASC']);
        $adsDesc = $adRepository->findLast();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'marketers' => $marketers,
            'adsDesc' => $adsDesc

        ]);
    }
}
