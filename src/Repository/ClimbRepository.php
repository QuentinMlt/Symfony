<?php

namespace App\Repository;

use App\Entity\Climb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Climb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Climb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Climb[]    findAll()
 * @method Climb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClimbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Climb::class);
    }

    public function listClimb():Query
    {
        return $this->createQueryBuilder('climb')
            ->orderBy('climb.date','ASC')
            ->getQuery()
        ;
    }

    // /**
    //  * @return Climb[] Returns an array of Climb objects
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
    public function findOneBySomeField($value): ?Climb
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
