<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
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

    /**
     * @return Product[]
     */
    public function findAllWithPC()
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.pc', 'pers')
            ->getQuery()
            ->getResult()
            ;
    }



    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function getEx7(string $maker)
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $sql = "SELECT p.model, price FROM PC t1 LEFT JOIN Product p ON p.id = t1.model_id WHERE p.maker = :maker
                UNION
                SELECT p.model, price FROM Laptop t2 LEFT JOIN Product p ON p.id = t2.model_id WHERE p.maker = :maker
                UNION
                SELECT p.model, price FROM Printer t3 LEFT JOIN Product p ON p.id = t3.model_id WHERE p.maker = :maker";

        $stmt = $conn->prepare($sql);
        //$stmt->bindValue("maker", $maker);
        $stmt->execute(["maker" => $maker]);

        return $stmt->fetchAll();
    }
}
