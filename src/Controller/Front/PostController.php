<?php

namespace App\Controller\Front;

use App\Entity\Categorie;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Translation\TranslatableMessage;

class PostController extends AbstractController
{
    /**
     * ?Route pour afficher les articles d'une catégorie
     * 
     */
    #[Route(
        path:[
            "fr"=>'/post/{_locale}/article-au-sujet-de-{nom}',
            "en"=>'/post/{_locale}/article-about-{nom}'
        ],
        name: 'app_front_post',
        methods:['GET'], 
        requirements:[
            '_locale'=>'fr|en'
            ])
        ]
    public function categorie(Categorie $categorie, string $_locale = 'fr'): Response
    {
        //get all posts from categorie
        $posts = $categorie->getPosts();
        $title = new TranslatableMessage($categorie->getPosts()->first()->getTitre(), [], 'post') ;

        return $this->render('front/post/category.html.twig', [
            'posts' => $posts,
            'title' => $title,
            'controller_name' => 'PostController',
        ]);
    }


    /**
     * ?Route pour lire un article
     * Affichera un lecteur audio, un lectueur video ou une page d'article selon post.format
     */
    #[Route(path:'/post/{_locale}/{slug}', name: 'app_front_post_show', methods:['GET'], requirements:['_locale'=>'fr|en']) ]
    public function readArticle(Post $post ,Request $request, string $_locale = 'fr'): Response
    {
        return $this->render('front/post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }
}
