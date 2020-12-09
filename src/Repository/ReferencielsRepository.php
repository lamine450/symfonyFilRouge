<?php

namespace App\Repository;

use App\Entity\Referenciels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Referenciels|null find($id, $lockMode = null, $lockVersion = null)
 * @method Referenciels|null findOneBy(array $criteria, array $orderBy = null)
 * @method Referenciels[]    findAll()
 * @method Referenciels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferencielsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Referenciels::class);
    }

    // /**
    //  * @return Referenciels[] Returns an array of Referenciels objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Referenciels
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
