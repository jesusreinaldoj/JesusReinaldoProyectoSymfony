<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\PlayList;
use App\Entity\PlayListCancion;
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
    public function crearPlaylistCancion(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
    $playlist=$entityManagerInterface->getRepository(PlayList::class);
    $cancion=$entityManagerInterface->getRepository(Cancion::class);

    $playlist_encontrada=$playlist->buscarporNombre("PlayList1");
    $cancion_encontrada=$cancion->buscarporNombre("Cancion1");

    $playlistCancion=new PlayListCancion();
    $playlistCancion->setPlaylist($playlist_encontrada);
    $playlistCancion->setCancion($cancion_encontrada);
    $playlistCancion->setReproducida(0);

    $entityManagerInterface->persist($playlistCancion);
    $entityManagerInterface->flush();


        return $this->json([
            'message' => 'PlayListCancion creado!',
            'path' => 'src/Controller/PlaylistCancionController.php',
        ]);
    }
}
