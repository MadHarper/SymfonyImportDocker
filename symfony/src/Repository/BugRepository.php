<?php

namespace App\Repository;

use App\Entity\Bug;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bug|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bug|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bug[]    findAll()
 * @method Bug[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BugRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bug::class);
    }

    // /**
    //  * @return Bug[] Returns an array of Bug objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function getBugsWithReporterAndEngineerDQL()
    {
        $dql = "SELECT b, e, r FROM App:Bug b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults(10);
        return $query->getResult();
    }

    public function getBugsByStatusDQL(string $status)
    {
        $dql = "SELECT b, e, r FROM App:Bug b JOIN b.engineer e JOIN b.reporter r " .
                "WHERE b.status = ?1 ORDER BY b.created DESC";

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter(1, $status)
            ->getResult();
    }

    public function countOpenBugsForProductDQL(int $productId): array
    {
        $dql = "SELECT p.model, COUNT(b.id) as bugCount FROM App:Bug b JOIN b.products p " .
            "WHERE b.status = 'OPEN' AND p.id = ?1 GROUP BY p.model";

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter(1, $productId)
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Bug
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
