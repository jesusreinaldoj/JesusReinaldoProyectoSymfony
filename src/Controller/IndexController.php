<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Cancion;
use Doctrine\ORM\EntityManagerInterface;

final class IndexController extends AbstractController
{
    #[Route('/paginaprincipal', name: 'app_paginaprincipal')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        
        $cancionRepository=$entityManagerInterface->getRepository(Cancion::class);

        $canciones_encontradas=$cancionRepository->findAll();


        return $this->render('index/index.html.twig', [
            'controller_name' => 'paginaPrincipal',
            'canciones'=>$canciones_encontradas

            ]);
    }

    








}


