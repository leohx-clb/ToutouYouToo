<?php

namespace App\Controller;

use App\Repository\MarketerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private MarketerRepository $marketerRepository;

    /**
     * @Route("/", name="home")
     */
    public function index(MarketerRepository $marketerRepository): Response
    {
        $this->marketerRepository = $marketerRepository;
        $marketers = $marketerRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'marketers' => $marketers
        ]);
    }
}
