<?php

namespace App\Controller\Front;

use App\Repository\CategorieRepository;
use App\Repository\FormatRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FormatRepository $formatRepo, CategorieRepository $categorieRepo, PostRepository $postRepo, TranslatorInterface $translator): Response
    {
        $latestPost = $postRepo->findBy([],["id" => "DESC"], 20);
        foreach ($latestPost as $post) {
            $post->setTitre($translator->trans($post->getTitre(), domain: 'messages'));
            $post->setDescription($translator->trans($post->getDescription(), domain: 'messages'));


        }

        return $this->render('front/home/index.html.twig', [
            'latest_post' => $latestPost,
            'controller_name' => 'HomeController',
        ]);
    }
}
