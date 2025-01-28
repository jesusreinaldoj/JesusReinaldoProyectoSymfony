<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Usuario;

final class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'app_usuario')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }

    #[Route('/usuario/new', name: 'app_usuario_new')]
    public function crearUsuario(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        
        $usuario=new Usuario();
        $usuario->setEmail("email1");
        $usuario->setPassword("Contrasena1");

        $entityManagerInterface->persist($usuario);
        $entityManagerInterface->flush();


        return $this->json([
            'message' => 'Usuario Creado!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }
}
