<?php

namespace App\Repository;

use App\Entity\Playlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Playlist>
 */
class PlaylistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Playlist::class);
    }

    //    /**
    //     * @return Playlist[] Returns an array of Playlist objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

       public function buscarporNombre($nombre): ?Playlist
       {
           return $this->createQueryBuilder('p')
               ->andWhere('p.nombre = :val')
               ->setParameter('val', $nombre)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }

       public function obtenerLikesporPlaylist(){
        $result = $this->createQueryBuilder('p')
            ->select('p.nombre as nombre, p.likes as likes')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();

        // Transformar el resultado al formato JSON deseado
        $formattedResults = array_map(function($item) {
            return [
                'playlist' => $item['nombre'],
                'totalReproducciones' => $item['likes']
            ];
        }, $result);

        return $formattedResults;
       }
}
