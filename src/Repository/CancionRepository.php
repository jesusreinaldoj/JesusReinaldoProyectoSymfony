<?php

namespace App\Repository;

use App\Entity\Cancion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cancion>
 */
class CancionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cancion::class);
    }

    //    /**
    //     * @return Cancion[] Returns an array of Cancion objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

       public function buscarporNombre($nombre): ?Cancion
       {
           return $this->createQueryBuilder('c')
               ->andWhere('c.titulo = :val')
               ->setParameter('val', $nombre)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }

       public function obtenerCancionesMasReproducidas(){
        $result = $this->createQueryBuilder('c')
            ->select('c.titulo as titulo, c.reproducciones as totalReproducciones')
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult();

        // Transformar el resultado al formato JSON deseado
        $formattedResults = array_map(function($item) {
            return [
                'titulo' => $item['titulo'],
                'totalReproducciones' => $item['totalReproducciones']
            ];
        }, $result);

        return $formattedResults;
       }


}
