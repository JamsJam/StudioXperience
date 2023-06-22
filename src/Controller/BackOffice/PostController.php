<?php

namespace App\Controller\BackOffice;

use App\Entity\Post;
use App\Form\PostType;
use DateTimeImmutable;
use App\Entity\Calendrier;
use App\Repository\PostRepository;
use App\Service\TranslationService;
use App\Repository\FormatRepository;
use App\Repository\CalendrierRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\LocaleSwitcher;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/back/office/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_back_office_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository, TranslatorInterface $translator,Request $request): Response
    {


        
                //? translation test




                //? ====================

        return $this->render('back_office/post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_office_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostRepository $postRepository, HtmlSanitizerInterface $htmlSanitizer, CalendrierRepository $cr, FormatRepository $formatRepository, TranslationService $translation): Response
    {

        // $localeSwitcher->setLocale( "fr_FR");
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

            
            //? ============================================================
            //* ===========  Handle form and translate  ====================
            //! ============================================================

                //? ===========  Handle form  ====================

                    $data = $form->getData();
                    $post->setPublishAt(DateTimeImmutable::createFromMutable($form->get('publishAt')->getData()));

                //! ==============================================

                
                //? =========== Handle Text content  =============
                    if($data["corps"]){

                        $content = $data->getCorps();
                        $content = $htmlSanitizer->sanitize($content);
                        $post->setCorps($content);
                    }
                //! ==============================================


                //? ===========  Handle video  ====================
                    if($form->get("video")->getData()){

                        $file = $form->get("video")->getData();
                        dump($form->get("video")->getData(),$file->getFileName());
                        
                        $fileExt = $file->guessExtension();
                        
                        // $fileName = $file->getFileName();
                        
                        $fileName = $post->getTitre().".".$fileExt;
                        
                        // $file->setFileName($fileName);
                        $file->move( $this->getParameter('article_video'), $fileName);
                    }
                //! ==============================================

                //? ===========  Handle audio  ====================
                    if($data["audio"]){
                        $file = $data["audio"];
                        $fileExt = $file->guessExtension();
                        $fileName = $post->getTitre().".".$fileExt;
                        $file->move( $this->getParameter('article_audio'), $fileName);
                    }
                //! ==============================================
                
                //? ===========  Handle slug  =====================
                    $slug = str_replace(" ","-",$post->getTitre()."--".$post->getTheme()."-".$post->getPublishAt()->format('Y-m-d'));
                    $post->setSlug($slug);
                //! ==============================================
                
                //? ===========  Handle calendar  =================
                
                    $calendar = new Calendrier;
                    $calendar 
                    ->setTitle($post->getTitre())
                    ->setBeginAt($post->getPublishAt())
                    ->setEndAt($calendar->getBeginAt());
                
                //! ==============================================

                
                //? =========== persist and flush  ===============
                    $postRepository->save($post, true);
                    $cr->save($calendar,true);
                //! ==============================================


                //? ===========  Handle translate  ================

                    $translation->addTranslationToArticle($post->getId(), $post->getTitre(), $post->getCorps(), 'en_US');

                //! ==============================================

            //! ============================================================

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
