<?php

namespace App\Repository;

use App\Entity\Pc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pc[]    findAll()
 * @method Pc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PcRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pc::class);
    }

    // /**
    //  * @return Pc[] Returns an array of Pc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pc
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
