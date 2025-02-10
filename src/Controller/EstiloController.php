<?php

namespace App\Controller;

use App\Entity\Estilo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

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

    #[Route('/estilo/new', name: 'app_estilo_new')]
    public function crearEstilo(EntityManagerInterface $entityManagerInterface): JsonResponse
    {

        $estilo=new Estilo();
        $estilo->setNombre("Rock");
        $estilo->setDescripcion("descripcion1");

        $entityManagerInterface->persist($estilo);
        $entityManagerInterface->flush();

        return $this->json([
            'message' => 'Estilo creado!',
            'path' => 'src/Controller/EstiloController.php',
        ]);
    }
}
