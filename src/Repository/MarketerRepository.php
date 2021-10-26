<?php

namespace App\Repository;

use App\Entity\Marketer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Marketer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marketer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marketer[]    findAll()
 * @method Marketer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marketer::class);
    }

    // /**
    //  * @return Marketer[] Returns an array of Marketer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Marketer
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
