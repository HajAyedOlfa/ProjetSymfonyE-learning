<?php

namespace App\Repository;

use App\Entity\Mdp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mdp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mdp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mdp[]    findAll()
 * @method Mdp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MdpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mdp::class);
    }

    // /**
    //  * @return Mdp[] Returns an array of Mdp objects
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
    public function findOneBySomeField($value): ?Mdp
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
