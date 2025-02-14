<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PlaylistCancionRepository;

final class PlaylistController extends AbstractController
{
    #[Route('/playlist', name: 'app_playlist')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlaylistController.php',
        ]);
    }

    #[Route('/playlist/new', name: 'app_playlist_new')]
    public function crearPlaylist(EntityManagerInterface $entityManagerInterface): JsonResponse
    {

        $playlist=new Playlist();
        $playlist->setNombre("playlist1");
        $playlist->setVisibilidad("privado");

        $usuario=$entityManagerInterface->getRepository(Usuario::class);
        $usuario_encontrado=$usuario->buscarporNombre("nombre1");
        
        $playlist->setUsuarioPropietario($usuario_encontrado);
        $playlist->setLikes(0);

        $entityManagerInterface->persist($playlist);
        $entityManagerInterface->flush();



        return $this->json([
            'message' => 'Playlist creada!',
            'path' => 'src/Controller/PlaylistController.php',
        ]);
    }


    #[Route('/playlist/{id}/canciones', name: 'playlist_canciones')]
    public function canciones(int $id, PlaylistCancionRepository $playlistCancionRepository): Response
    {
        $playlistData = $playlistCancionRepository->buscarPorID($id);

        if (empty($playlistData)) {
            throw $this->createNotFoundException('Playlist no encontrada');
        }

        $playlistNombre = $playlistData[0]->getPlaylist()->getNombre();

        return $this->render('playlist/playlistCancion.html.twig', [
            'playlistNombre' => $playlistNombre,
            'canciones' => $playlistData
        ]);
    }



}
