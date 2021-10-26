<?php

namespace App\Repository;

use App\Entity\Adopting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adopting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adopting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adopting[]    findAll()
 * @method Adopting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdoptingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adopting::class);
    }

    // /**
    //  * @return Adopting[] Returns an array of Adopting objects
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
    public function findOneBySomeField($value): ?Adopting
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
