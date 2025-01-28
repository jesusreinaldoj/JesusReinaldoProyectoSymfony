<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Cancion;
use App\Entity\Estilo;

final class CancionController extends AbstractController
{
    #[Route('/cancion', name: 'app_cancion')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CancionController.php',
        ]);
    }

    #[Route('/cancion/new/{nombre}', name: 'app_cancion_new')]
    public function crearCancion(EntityManagerInterface $entityManagerInterface,$nombre): JsonResponse
    {

        $estilo=$entityManagerInterface->getRepository(Estilo::class);
        $estilo_encontrado=$estilo->buscarporID(1);


        $cancion=new Cancion();
        $cancion->setNombre($nombre);
        $cancion->setDuracion(0);
        $cancion->setAutor("Autor 1");
        $cancion->setUbicacion("Pais 1");
        $cancion->setLikes(0);
        $cancion->setGenero($estilo_encontrado);
        $cancion->setAlbum("Album 1");
        $cancion->setReproducciones(0);

        $entityManagerInterface->persist($cancion);
        $entityManagerInterface->flush();



        return $this->json([
            'message' => 'Cancion creada!',
            'path' => 'src/Controller/CancionController.php',
        ]);
    }
}
