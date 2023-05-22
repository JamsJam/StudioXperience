<?php

namespace App\Controller\BackOffice;

use App\Entity\Post;
use App\Form\PostType;
use DateTimeImmutable;
use App\Entity\Calendrier;
use App\Repository\PostRepository;
use App\Repository\FormatRepository;
use App\Repository\CalendrierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/back/office/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_back_office_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {

        return $this->render('back_office/post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_office_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostRepository $postRepository, HtmlSanitizerInterface $htmlSanitizer, CalendrierRepository $cr, FormatRepository $formatRepository): Response
    {
        $formatArray = [];
        $formats = $formatRepository->findAll();

        foreach ($formats as $format) {
            array_push($formatArray, $format->getNom());
        }
        //? redirect if format is not in the formatArray
        if (!in_array($request->query->get('format'), $formatArray , true)) {
            return $this->redirectToRoute('app_back_office_getformat');
        } 
            
        $format = $request->query->get('format');
        

        $post = new Post();
        $form = $this->createForm(PostType::class, $post, ['format' => $format]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($request->query);
            $calendar = new Calendrier;
            $calendar 
                ->setTitle($post->getTitre())
                ->setBeginAt(DateTimeImmutable::createFromMutable($form->get('publishAt')->getData()))
                ->setEndAt($calendar->getBeginAt());
            // dd(DateTimeImmutable::createFromMutable($form->get('publishAt')->getData())) ;
            $post->setPublishAt(DateTimeImmutable::createFromMutable($form->get('publishAt')->getData()));


            // // ! DD de la valeur retour de TinyMCE pour le corps du post (pour voir les balises HTML) 
            // dd($post->getCorps());

            $post->setCorps($htmlSanitizer->sanitizeFor("textarea",$post->getCorps()));
            
            $postRepository->save($post, true);
            $cr->save($calendar,true);

            return $this->redirectToRoute('app_back_office_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_office_post_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('back_office/post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_office_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, PostRepository $postRepository): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postRepository->save($post, true);

            return $this->redirectToRoute('app_back_office_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back_office/post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_office_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, PostRepository $postRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postRepository->remove($post, true);
        }

        return $this->redirectToRoute('app_back_office_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
