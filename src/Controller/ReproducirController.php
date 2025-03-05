<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class ReproducirController extends AbstractController
{
    public function playMusic(string $songName, LoggerInterface $logger): Response
    {
        $musicDirectory = $this->getParameter('kernel.project_dir') . '/songs/';
        $filePath = $musicDirectory . $songName;
        
        // Registrar en el canal específico
        $logger->info('Reproduciendo canción: ' . $songName, [
            'channel' => 'reproducir_musica',
            'song_name' => $songName
        ]);
    
        if (!file_exists($filePath)) {
            $logger->error('Archivo no encontrado: ' . $filePath, [
                'channel' => 'reproducir_musica',
                'file_path' => $filePath
            ]);
            return new Response('Archivo no encontrado', 404);
        }
        return new BinaryFileResponse($filePath);
    }
}