<?php

namespace App\Repository;

use App\Entity\Cancion;
use App\Entity\PlaylistCancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaylistCancion>
 */
class PlaylistCancionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistCancion::class);
    }

    //    /**
    //     * @return PlaylistCancion[] Returns an array of PlaylistCancion objects
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

    public function buscarPorID($id): array
    {
        return $this->createQueryBuilder('pc')
            ->join('pc.cancion', 'c')
            ->addSelect('c')
            ->where('pc.playlist = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    public function obtenerReproduccionesPorPlaylist(): array
    {
        return $this->createQueryBuilder('pc')
            ->select('p.nombre AS playlist, SUM(pc.reproducciones) AS totalReproducciones')
            ->join('pc.playlist', 'p')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }
}
