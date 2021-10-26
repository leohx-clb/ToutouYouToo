<?php

namespace App\Repository;

use App\Entity\TypeMarketer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeMarketer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMarketer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMarketer[]    findAll()
 * @method TypeMarketer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMarketerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMarketer::class);
    }

    // /**
    //  * @return TypeMarketer[] Returns an array of TypeMarketer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeMarketer
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
