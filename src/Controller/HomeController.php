<?php

namespace App\Controller;

use App\Repository\DogRepository;
use App\Repository\MarketerRepository;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private MarketerRepository $marketerRepository;
    private DogRepository $dogRepository;
    private PictureRepository $pictureRepository;

    /**
     * @Route("/", name="home")
     * @param MarketerRepository $marketerRepository
     * @param DogRepository $dogRepository
     * @param PictureRepository $pictureRepository
     * @return Response
     */
    public function index(MarketerRepository $marketerRepository, DogRepository $dogRepository, PictureRepository $pictureRepository): Response
    {
        $this->marketerRepository = $marketerRepository;
        $marketers = $marketerRepository->findAll();
        $this->dogRepository = $dogRepository;
        $dogs = $dogRepository->findAll();
        $this->pictureRepository = $pictureRepository;
        $pictures = $pictureRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'marketers' => $marketers,
            'dogs' => $dogs,
            'pictures' => $pictures

        ]);
    }
}
