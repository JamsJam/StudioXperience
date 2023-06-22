<?php

namespace App\Controller\BackOffice;

use App\Entity\Calendrier;
use App\Form\CalendrierType;
use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('back/office/calendrier')]
class CalendrierController extends AbstractController
{

    //Code tiré de la doc FullCalendar symfony integration pour afficher le calendrier
    
    /**
     * @Route("/", name="app_booking_calendar", methods={"GET"})
     */
    // public function calendar(): Response
    // {
    //     return $this->render('calendrier/index.html.twig');
    // }

    #[Route('/', name: 'app_back_office_calendrier_index', methods: ['GET','POST'])]
    public function index(Request $request,CalendrierRepository $calendrierRepository): Response
    {
        $events = $calendrierRepository->findAll();
        $eventsJson = json_encode($events);

        $calendrier = new Calendrier();
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendrierRepository->save($calendrier, true);

            return $this->redirectToRoute('app_back_office_calendrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/back_office/calendrier/index.html.twig', [
            'calendriers' => $calendrierRepository->findAll(),
            'events_json' => $eventsJson,
            'calendrier' => $calendrier,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_back_office_calendrier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CalendrierRepository $calendrierRepository): Response
    {
        $calendrier = new Calendrier();
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendrierRepository->save($calendrier, true);

            return $this->redirectToRoute('app_back_office_calendrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/back_office/calendrier/new.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_back_office_calendrier_show', methods: ['GET'])]
    public function show(Calendrier $calendrier): Response
    {
        return $this->render('/back_office/calendrier/show.html.twig', [
            'calendrier' => $calendrier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_office_calendrier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Calendrier $calendrier, CalendrierRepository $calendrierRepository): Response
    {
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendrierRepository->save($calendrier, true);

            return $this->redirectToRoute('app_back_office_calendrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/back_office/calendrier/edit.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_office_calendrier_delete', methods: ['POST'])]
    public function delete(Request $request, Calendrier $calendrier, CalendrierRepository $calendrierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendrier->getId(), $request->request->get('_token'))) {
            $calendrierRepository->remove($calendrier, true);
        }

        return $this->redirectToRoute('app_back_office_calendrier_index', [], Response::HTTP_SEE_OTHER);
    }

}

