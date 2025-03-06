<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\Cancion;
use App\Entity\PlaylistCancion;
use App\Entity\User;
use App\Entity\Usuario;
use App\Form\PlaylistType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;
use App\Repository\PlaylistCancionRepository;
use App\Repository\CancionRepository;
use Proxies\__CG__\App\Entity\Usuario as EntityUsuario;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Http\Attribute\IsGranted as AttributeIsGranted;
use App\Repository\PlaylistRepository;
use Psr\Log\LoggerInterface;

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

        $playlist = new Playlist();
        $playlist->setNombre("playlist1");
        $playlist->setVisibilidad("privado");

        $usuario = $entityManagerInterface->getRepository(User::class);
        $usuario_encontrado = $usuario->buscarporNombre("jesus@gmail.com");

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


    #[AttributeIsGranted('ROLE_USUARIO')]
#[Route('/playlist/crearPlaylistUsuario', name: 'playlist_usuario')]
public function crearPlaylistUsuario(
    Request $request,
    EntityManagerInterface $entityManager,
    CancionRepository $cancionRepository,
    LoggerInterface $logger
): Response {
    $playlist = new Playlist();
    $canciones = $cancionRepository->findAll();

    $form = $this->createFormBuilder($playlist)
        ->add('nombre', null, [
            'label' => 'Nombre de la Playlist',
            'attr' => ['class' => 'form-control']
        ])
        ->add('visibilidad', ChoiceType::class, [
            'choices' => [
                'Pública' => 'publico',
                'Privada' => 'privado'
            ],
            'label' => 'Visibilidad',
            'attr' => ['class' => 'form-control']
        ])->getForm();

    $form->handleRequest($request);

    $selectedCanciones = [];
    $errorMessage = null;

    if ($form->isSubmitted() && $form->isValid()) {
        $usuario = $this->getUser();

        if (!$usuario) {
            $this->addFlash('error', 'Debes iniciar sesión para crear una playlist.');
            return $this->redirectToRoute('app_login');        
        }

        $playlist->setUsuarioPropietario($usuario);
        $playlist->setLikes(0);
        $playlist->setReproducciones(0);

        $selectedCanciones = $request->get('canciones', []);

        $logger->notice('NOTICE playlist creada por ' . $usuario);

        if (empty($selectedCanciones)) {
            $errorMessage = 'Debes seleccionar al menos una canción para tu playlist.';
        } else {
            $entityManager->persist($playlist);
            $entityManager->flush();

            foreach ($selectedCanciones as $cancionId) {
                $cancion = $cancionRepository->find($cancionId);
                if ($cancion) {
                    $playlistCancion = new PlaylistCancion();
                    $playlistCancion->setPlaylist($playlist);
                    $playlistCancion->setCancion($cancion);
                    $playlistCancion->setReproducciones(0);
                    $entityManager->persist($playlistCancion);
                }
            }

            $entityManager->flush();
            $this->addFlash('success', 'Playlist creada correctamente!');
            return $this->redirectToRoute('playlist_canciones', ['id' => $playlist->getId()]);
        }
    }

    return $this->render('playlist/crear_playlist.html.twig', [
        'form' => $form->createView(),
        'canciones' => $canciones,
        'selectedCanciones' => $selectedCanciones,
        'errorMessage' => $errorMessage
    ]);
}

#[AttributeIsGranted('ROLE_USUARIO')]
#[Route('/mis-playlists', name: 'mis_playlists')]
public function misPlaylists(PlaylistRepository $playlistRepository): Response
{
    $user = $this->getUser();
    if (!$user) {
        $this->addFlash('error', 'Debes iniciar sesión para ver tus playlists');
        return $this->redirectToRoute('app_login');
    }

    $misPlaylists = $playlistRepository->findBy([
        'usuarioPropietario' => $user
    ]);

    return $this->render('playlist/mis_playlist.html.twig', [
        'misPlaylists' => $misPlaylists
    ]);
}
}
