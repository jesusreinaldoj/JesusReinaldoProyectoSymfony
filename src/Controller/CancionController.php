<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\Estilo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

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

    #[Route('/cancion/new', name: 'app_cancion_new')]
    public function crearCancion(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $cancion=new Cancion();
        $cancion->setTitulo("Cancion1");
        $cancion->setDuracion(2.22);
        $cancion->setAutor("Autor1");
        
        $estilo=$entityManagerInterface->getRepository(Estilo::class);
        $estilo_encontrado=$estilo->buscarporNombre("Rock");
        $cancion->setGenero($estilo_encontrado);
        $cancion->setLikes(0);

        $entityManagerInterface->persist($cancion);
        $entityManagerInterface->flush();
       



        return $this->json([
            'message' => 'Cancion creada!',
            'path' => 'src/Controller/CancionController.php',
        ]);
    }
}
