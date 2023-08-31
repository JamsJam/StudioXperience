<?php

namespace App\Controller\Back;

use App\Entity\Thematique;
use App\Form\ThematiqueType;
use App\Repository\ThematiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/thematique')]
class ThematiqueController extends AbstractController
{
    #[Route('/', name: 'app_back_thematique_index', methods: ['GET'])]
    public function index(ThematiqueRepository $thematiqueRepository): Response
    {
        return $this->render('back/thematique/index.html.twig', [
            'thematiques' => $thematiqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_thematique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $thematique = new Thematique();
        $form = $this->createForm(ThematiqueType::class, $thematique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($thematique);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_thematique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/thematique/new.html.twig', [
            'thematique' => $thematique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_thematique_show', methods: ['GET'])]
    public function show(Thematique $thematique): Response
    {
        return $this->render('back/thematique/show.html.twig', [
            'thematique' => $thematique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_thematique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Thematique $thematique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ThematiqueType::class, $thematique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_back_thematique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/thematique/edit.html.twig', [
            'thematique' => $thematique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_thematique_delete', methods: ['POST'])]
    public function delete(Request $request, Thematique $thematique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$thematique->getId(), $request->request->get('_token'))) {
            $entityManager->remove($thematique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_thematique_index', [], Response::HTTP_SEE_OTHER);
    }
}
