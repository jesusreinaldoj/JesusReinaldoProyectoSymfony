<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\PlayList;

final class PlayListController extends AbstractController
{
    #[Route('/play/list', name: 'app_play_list')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlayListController.php',
        ]);
    }


    #[Route('/playlist/new/{nombre}', name: 'app_play_list_new')]
    public function crearPlayList(EntityManagerInterface $entityManagerInterface,$nombre): JsonResponse
    {

        $playlist=new PlayList();

        $playlist->setNombre($nombre);
        $playlist->setLikes(0);
        $playlist->setVisibilidad("privada");

        $entityManagerInterface->persist($playlist);
        $entityManagerInterface->flush();



        return $this->json([
            'message' => 'PlayList creado!',
            'path' => 'src/Controller/PlayListController.php',
        ]);
    }
}
