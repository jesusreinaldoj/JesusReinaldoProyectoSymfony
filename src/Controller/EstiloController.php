<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Estilo;
use Doctrine\ORM\EntityManagerInterface;

final class EstiloController extends AbstractController
{
    #[Route('/estilo', name: 'app_estilo')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }


    #[Route('/estilo/new/{nombre}', name: 'app_estilo_new')]
    public function crearEstilo(EntityManagerInterface $entityManagerInterface,$nombre): JsonResponse
    {
        $estilo=new Estilo();
        $estilo->setNombre($nombre);
        $estilo->setDescripcion("Estilo " . $nombre);

        $entityManagerInterface->persist($estilo);
        $entityManagerInterface->flush();






        return $this->json([
            'message' => 'Estilo creado!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }
}
