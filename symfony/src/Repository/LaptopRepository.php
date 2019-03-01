<?php

namespace App\Repository;

use App\Entity\Laptop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Laptop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Laptop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Laptop[]    findAll()
 * @method Laptop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaptopRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Laptop::class);
    }

    // /**
    //  * @return Laptop[] Returns an array of Laptop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Laptop
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
