<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\Playlist;
use App\Entity\PlaylistCancion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistCancionController extends AbstractController
{
    #[Route('/playlist/cancion', name: 'app_playlist_cancion')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlaylistCancionController.php',
        ]);
    }

    #[Route('/playlist/cancion/new', name: 'app_playlist_cancion_new')]
    public function unirCancionConPlaylist(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $playlistCancion=new PlaylistCancion();

        $playlist=$entityManagerInterface->getRepository(Playlist::class);
        $playlist_encontrada=$playlist->buscarporNombre("playlist1");

        $playlistCancion->setPlaylist($playlist_encontrada);

        $cancion=$entityManagerInterface->getRepository(Cancion::class);
        $cancion_encontrada=$cancion->buscarporNombre("Cancion1");

        $playlistCancion->setCancion($cancion_encontrada);
        $playlistCancion->setReproducciones(0);

        $entityManagerInterface->persist($playlistCancion);
        $entityManagerInterface->flush();



        return $this->json([
            'message' => 'Cancion añadida a la playlist!',
            'path' => 'src/Controller/PlaylistCancionController.php',
        ]);
    }
}
