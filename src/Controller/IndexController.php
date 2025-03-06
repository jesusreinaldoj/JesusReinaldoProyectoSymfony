<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Cancion;
use App\Entity\Playlist;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PlaylistRepository;

final class IndexController extends AbstractController
{
    #[Route('/paginaprincipal', name: 'app_paginaprincipal')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        $playlistRepository=$entityManagerInterface->getRepository(Playlist::class);

        $playlist_encontradas=$playlistRepository->findAll();

        $cancionRepository=$entityManagerInterface->getRepository(Cancion::class);

        $canciones_encontradas=$cancionRepository->findAll();


        return $this->render('index/index.html.twig', [
            'controller_name' => 'paginaPrincipal',
            'canciones'=>$canciones_encontradas,
            'playlists'=>$playlist_encontradas

            ]);
    }


    #[Route('/playlist/todas', name: 'app_paginaprincipal_playlist')]
    public function indexPlaylist(EntityManagerInterface $entityManagerInterface): Response
    {
        
        $playlistRepository=$entityManagerInterface->getRepository(Playlist::class);

        $playlist_encontradas=$playlistRepository->findAll();


        return $this->render('index/indexplaylist.html.twig', [
            'controller_name' => 'Mis playlists',
            'playlists'=>$playlist_encontradas

            ]);
    }
    #[Route('/cancion/todas', name: 'app_paginaprincipal_cancion')]
    public function indexCanciones(EntityManagerInterface $entityManagerInterface): Response
    {
        
        $cancionRepository=$entityManagerInterface->getRepository(Cancion::class);

        $canciones_encontradas=$cancionRepository->findAll();


        return $this->render('index/indexcancion.html.twig', [
            'controller_name' => 'canciones',
            'canciones'=>$canciones_encontradas

            ]);
    }

  /*   #[Route('/playlist/usuario', name: 'playlist_usuario')]
    public function indexPlaylistTodas(PlaylistRepository $playlistRepository): Response
    {
        $user = $this->getUser();
        $playlists = [];
        
        // If user is logged in, get their playlists
        if ($user) {
            $playlists = $playlistRepository->findBy([
                'usuarioPropietario' => $user
            ]);
        }

        // Get all public playlists
        $publicPlaylists = $playlistRepository->findBy([
            'visibilidad' => 'publico'
        ]);

        return $this->render('index.html.twig', [
            'playlists' => $playlists,
            'publicPlaylists' => $publicPlaylists
        ]);
    } */

    








}


