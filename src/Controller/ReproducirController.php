<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class ReproducirController extends AbstractController
{
    #[Route('/cancion/{songName}/play', name: 'play_music', methods: ['GET'])]    
    
    public function playMusic(string $songName): Response
    {
    $musicDirectory = $this->getParameter('kernel.project_dir') . '/songs/';
    $filePath = $musicDirectory . $songName;
    if (!file_exists($filePath)) {
    return new Response('Archivo no encontrado', 404);
    }
    return new BinaryFileResponse($filePath);}
}
