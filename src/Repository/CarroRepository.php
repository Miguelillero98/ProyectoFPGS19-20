<?php

namespace App\Repository;

use App\Entity\Carro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Carro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carro[]    findAll()
 * @method Carro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carro::class);
    }

    // /**
    //  * @return Carro[] Returns an array of Carro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Carro
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
