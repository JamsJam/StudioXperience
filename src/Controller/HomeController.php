<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\FormatRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(FormatRepository $formatRepo, CategorieRepository $categorieRepo, PostRepository $postRepo): Response
    {
        // $postTitre = $postRepo->findBy(
            
        // );

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
