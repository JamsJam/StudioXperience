<?php

namespace App\Controller\Back;

use App\Entity\Sousthematique;
use App\Form\SousthematiqueType;
use App\Repository\SousthematiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/sousthematique')]
class SousthematiqueController extends AbstractController
{
    #[Route('/', name: 'app_back_sousthematique_index', methods: ['GET'])]
    public function index(SousthematiqueRepository $sousthematiqueRepository): Response
    {
        return $this->render('back/sousthematique/index.html.twig', [
            'sousthematiques' => $sousthematiqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_sousthematique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sousthematique = new Sousthematique();
        $form = $this->createForm(SousthematiqueType::class, $sousthematique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sousthematique);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_sousthematique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/sousthematique/new.html.twig', [
            'sousthematique' => $sousthematique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_sousthematique_show', methods: ['GET'])]
    public function show(Sousthematique $sousthematique): Response
    {
        return $this->render('back/sousthematique/show.html.twig', [
            'sousthematique' => $sousthematique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_sousthematique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sousthematique $sousthematique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SousthematiqueType::class, $sousthematique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_back_sousthematique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/sousthematique/edit.html.twig', [
            'sousthematique' => $sousthematique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_sousthematique_delete', methods: ['POST'])]
    public function delete(Request $request, Sousthematique $sousthematique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousthematique->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sousthematique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_sousthematique_index', [], Response::HTTP_SEE_OTHER);
    }
}
