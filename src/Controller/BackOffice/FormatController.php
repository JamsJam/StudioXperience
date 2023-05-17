<?php

namespace App\Controller\BackOffice;

use App\Entity\Format;
use App\Form\FormatType;
use App\Repository\FormatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/office/format')]
class FormatController extends AbstractController
{
    #[Route('/', name: 'app_back_office_format_index', methods: ['GET'])]
    public function index(FormatRepository $formatRepository): Response
    {
        return $this->render('back_office/format/index.html.twig', [
            'formats' => $formatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_office_format_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormatRepository $formatRepository): Response
    {
        $format = new Format();
        $form = $this->createForm(FormatType::class, $format);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formatRepository->save($format, true);

            return $this->redirectToRoute('app_back_office_format_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/format/new.html.twig', [
            'format' => $format,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_office_format_show', methods: ['GET'])]
    public function show(Format $format): Response
    {
        return $this->render('back_office/format/show.html.twig', [
            'format' => $format,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_office_format_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Format $format, FormatRepository $formatRepository): Response
    {
        $form = $this->createForm(FormatType::class, $format);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formatRepository->save($format, true);

            return $this->redirectToRoute('app_back_office_format_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_office/format/edit.html.twig', [
            'format' => $format,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_office_format_delete', methods: ['POST'])]
    public function delete(Request $request, Format $format, FormatRepository $formatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$format->getId(), $request->request->get('_token'))) {
            $formatRepository->remove($format, true);
        }

        return $this->redirectToRoute('app_back_office_format_index', [], Response::HTTP_SEE_OTHER);
    }
}
