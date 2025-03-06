<?php

namespace App\Controller\Manager;

use App\Repository\CancionRepository;
use App\Repository\PlaylistCancionRepository;
use App\Repository\PlaylistRepository;
use App\Repository\UserRepository;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/manager')]
#[IsGranted('ROLE_MANAGER')]
class EstadisticasController extends AbstractController
{
#[Route('/estadisticas', name: 'estadisticas')]
public function indexPlaylistReproducidas(PlaylistCancionRepository $playlistCancionRepository): Response
{
// Obtener datos de reproducciones por playlist
$datos = $playlistCancionRepository->obtenerReproduccionesPorPlaylist();
return $this->render('estadisticas/index.html.twig', [
'datos' => $datos
]);
}
#[Route('/estadisticas/datos', name: 'estadisticas_datos')]
public function obtenerDatosPlaylistReproducidas(PlaylistCancionRepository $playlistCancionRepository): JsonResponse
{
$datos = $playlistCancionRepository->obtenerReproduccionesPorPlaylist();
return $this->json($datos);// convierte el array $datos en una respuesta JSON.
}

#[Route('/estadisticas/datos/usuario', name: 'estadisticas_datos_usuario')]
public function obtenerDatosUsuariosRegistrados(UserRepository $userRepository): JsonResponse
{
$datos = $userRepository->usuariosRegistrados();
return $this->json($datos);// convierte el array $datos en una respuesta JSON.
}

#[Route('/estadisticas/datos/playlist/likes', name: 'estadisticas_datos_playlist_likes')]
public function obtenerDatosLikesPlaylist(PlaylistRepository $playlistRepository): JsonResponse
{
$datos = $playlistRepository->obtenerLikesporPlaylist();
return $this->json($datos);// convierte el array $datos en una respuesta JSON.
}

#[Route('/estadisticas/datos/cancion/reproducciones', name: 'estadisticas_datos_cancion_reproducciones')]
public function obtenerDatosCancionReproducciones(CancionRepository $cancionRepository): JsonResponse
{
$datos = $cancionRepository->obtenerCancionesMasReproducidas();
return $this->json($datos);// convierte el array $datos en una respuesta JSON.
}



}
