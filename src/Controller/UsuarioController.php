<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

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
        $usuario->setPassword("contra1");
        $usuario->setNombre("nombre1");
        $usuario->setFechaNacimiento("fecha1");

        $perfil=$entityManagerInterface->getRepository(Perfil::class);
        $perfil_encontrado=$perfil->buscarporID(1);

        $usuario->setPerfil($perfil_encontrado);

        $entityManagerInterface->persist($usuario);
        $entityManagerInterface->flush();

        return $this->json([
            'message' => 'Usuario creado!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }
}
