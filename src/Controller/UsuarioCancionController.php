<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\Usuario;
use App\Entity\UsuarioCancion;
use DateTimeInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


final class UsuarioCancionController extends AbstractController
{
    #[Route('/usuario/cancion', name: 'app_usuario_cancion')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioCancionController.php',
        ]);
    }

    #[Route('/usuario/cancion/new', name: 'app_usuario_cancion_new')]
    public function crearUsuarioCancion(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $usuario=$entityManagerInterface->getRepository(Usuario::class);
        $cancion=$entityManagerInterface->getRepository(Cancion::class);

        $usuario_encontrado=$usuario->buscarporNombre("email1");
        $cancion_encontrado=$cancion->buscarporNombre("Cancion1");

        $usuarioCancion=new UsuarioCancion();
        $usuarioCancion->setUsuario($usuario_encontrado);
        $usuarioCancion->setCancion($cancion_encontrado);

        $date = date_create('2024-01-28');
        

        $usuarioCancion->setFecha($date);
        $usuarioCancion->setMarcaTiempo(0);

        $entityManagerInterface->persist($usuarioCancion);
        $entityManagerInterface->flush();

        return $this->json([
            'message' => 'UsuarioCancion Creado!',
            'path' => 'src/Controller/UsuarioCancionController.php',
        ]);
    }
}
