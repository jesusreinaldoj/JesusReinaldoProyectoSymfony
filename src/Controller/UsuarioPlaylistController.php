<?php

namespace App\Controller;

use App\Entity\PlayList;
use App\Entity\User;
use App\Entity\Usuario;
use App\Entity\UsuarioPlayList;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


final class UsuarioPlaylistController extends AbstractController
{
    #[Route('/usuario/playlist', name: 'app_usuario_playlist')]
    public function index(): JsonResponse
    {

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioPlaylistController.php',
        ]);
    }

    #[Route('/usuario/playlist/new', name: 'app_usuario_playlist_new')]
    public function crearUsuarioPlayList(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $usuario=$entityManagerInterface->getRepository(User::class);
        $playlist=$entityManagerInterface->getRepository(PlayList::class);

        $usuario_encontrado=$usuario->buscarporNombre("jesus@gmail.com");
        $playlist_encontrado=$playlist->buscarporNombre("PlayList1");

        $usuarioPlaylist=new UsuarioPlayList();
        $usuarioPlaylist->setUsuario($usuario_encontrado);
        $usuarioPlaylist->setPlaylist($playlist_encontrado);
        $usuarioPlaylist->setReproducida(0);

        $entityManagerInterface->persist($usuarioPlaylist);
        $entityManagerInterface->flush();







        return $this->json([
            'message' => 'UsuarioPlayList creado!',
            'path' => 'src/Controller/UsuarioPlaylistController.php',
        ]);
    }
}
