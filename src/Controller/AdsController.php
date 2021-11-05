<?php

namespace App\Controller;

use App\Repository\AdRepository;
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\Ad;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdsController extends AbstractController
{
    private AdRepository  $adRepository;
    /**
     * @Route("/ads", name="ads")
     */
    public function index(Request $request, AdRepository $adRepository, PaginatorInterface $paginator): Response
    {
 //       $this->adRepository = $adRepository;

 //       $ads = $adRepository->findAll();
        $donnees = $this->getDoctrine()->getRepository(Ad::class)->findBy([],[]);
        $ads = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        return $this->render('ads/index.html.twig', [
            'controller_name' => 'AdsController',
            'ads' => $ads,
        ]);
    }
}
