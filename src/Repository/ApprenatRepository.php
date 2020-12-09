<?php

namespace App\Repository;

use App\Entity\Apprenat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apprenat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apprenat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apprenat[]    findAll()
 * @method Apprenat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApprenatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apprenat::class);
    }

    // /**
    //  * @return Apprenat[] Returns an array of Apprenat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Apprenat
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
