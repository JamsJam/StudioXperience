<?php

namespace App\Controller\BackOffice;

use App\Repository\FormatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetformatController extends AbstractController
{
    #[Route('/back/office/getformat', name: 'app_back_office_getformat')]
    public function index(FormatRepository $formatRepository): Response
    {

        return $this->render('back_office/getformat/index.html.twig', [
            "formats" => $formatRepository->findAll()
        ]);
    }
}
