<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Perfil;
use Doctrine\ORM\EntityManagerInterface;

final class PerfilController extends AbstractController
{
    #[Route('/perfil', name: 'app_perfil')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PerfilController.php',
        ]);
    }

    #[Route('/perfil/new', name: 'app_perfil_new')]
    public function crearPerfil(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $perfil=new Perfil();
        $perfil->setFoto("foto1");
        $perfil->setEdad(18);
        $perfil->setDescripcion("Descripcion perfil");

        $entityManagerInterface->persist($perfil);
        $entityManagerInterface->flush();




        return $this->json([
            'message' => 'Perfil creado!',
            'path' => 'src/Controller/PerfilController.php',
        ]);
    }
}
