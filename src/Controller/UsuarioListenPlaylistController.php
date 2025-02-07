<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\Usuario;
use App\Entity\UsuarioListenPlaylist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioListenPlaylistController extends AbstractController
{
    #[Route('/usuario/listen/playlist', name: 'app_usuario_listen_playlist')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioListenPlaylistController.php',
        ]);
    }

    #[Route('/usuario/listen/playlist/new', name: 'app_usuario_listen_playlist_new')]
    public function crearEscuchada(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $escuchada=new UsuarioListenPlaylist();

        $playlist=$entityManagerInterface->getRepository(Playlist::class);
        $playlist_escuchada=$playlist->buscarporNombre("playlist1");



        $usuario=$entityManagerInterface->getRepository(Usuario::class);
        $usuario_encontrado=$usuario->buscarporNombre("nombre1");


        $escuchada->setPlaylist($playlist_escuchada);
        $escuchada->setUsuario($usuario_encontrado);
        
        $entityManagerInterface->persist($escuchada);
        $entityManagerInterface->flush();




        return $this->json([
            'message' => 'Escuchada completa!',
            'path' => 'src/Controller/UsuarioListenPlaylistController.php',
        ]);
    }
}
