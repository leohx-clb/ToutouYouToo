<?php

namespace App\Repository;

use App\Entity\TypeMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMessage[]    findAll()
 * @method TypeMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMessage::class);
    }

    // /**
    //  * @return TypeMessage[] Returns an array of TypeMessage objects
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
    public function findOneBySomeField($value): ?TypeMessage
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
