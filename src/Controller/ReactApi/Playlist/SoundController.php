<?php

namespace App\Controller\ReactApi\Playlist;

use App\Repository\FormatRepository;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\JsonType;
use SebastianBergmann\Type\MixedType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SoundController extends AbstractController
{
    //! Permet de recuperer les playlist du lecteur audio
    //? 1) Recuperer 10 poadcast les plus recent
    //? 2) Recuperer les poadcaste de la categorie
    #[Route('/react/api/playlist/sound', name: 'app_react_api_playlist_sound')]
    public function getPoadcast(PostRepository $pr, FormatRepository $fr): JsonResponse
    {
        $format = $fr->findOneBy(['nom' => 'audio']);
        $playlist = $pr->findBy(
            ['format' =>  $format],
            ['id' => 'DESC'],
            10
        );
  
        
        
        return $this->json($playlist, Response::HTTP_OK, [], ['groups' => 'sound:playlist:all']);
    }
}
