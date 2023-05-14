<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/back/office/calendar', name: 'app_back_office_calendar')]
    public function index(): Response
    {
        return $this->render('back_office/calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }
}
