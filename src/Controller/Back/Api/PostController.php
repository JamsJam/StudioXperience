<?php

namespace App\Controller\Back\Api;

use App\Repository\ModuleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/back/api/post', name: 'app_back_api_post')]
    public function index(ModuleRepository $md): JsonResponse
    {
        $module = $md->findAll( );

        return $this->json(['data' => $module]);
    }
}
