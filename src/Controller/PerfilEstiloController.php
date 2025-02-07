<?php

namespace App\Controller;

use App\Entity\Estilo;
use App\Entity\Perfil;
use App\Entity\PerfilEstilo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


final class PerfilEstiloController extends AbstractController
{
    #[Route('/perfil/estilo', name: 'app_perfil_estilo')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PerfilEstiloController.php',
        ]);
    }

    #[Route('/perfil/estilo/new', name: 'app_perfil_estilo_new')]
    public function crearPerfilEstilo(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $perfil=$entityManagerInterface->getRepository(Perfil::class);

        $estilo=$entityManagerInterface->getRepository(Estilo::class);

        $perfil_encontrado=$perfil->buscarporID(1);
        
        $estilo_encontrado=$estilo->buscarporID(1);

        $perfilEstilo=new PerfilEstilo();

        $perfilEstilo->setPerfil($perfil_encontrado);
        $perfilEstilo->setEstilo($estilo_encontrado);
        
        $entityManagerInterface->persist($perfilEstilo);
        $entityManagerInterface->flush();


    



        return $this->json([
            'message' => 'PerfilEstilo creado!',
            'path' => 'src/Controller/PerfilEstiloController.php',
        ]);
    }
}
