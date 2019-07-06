<?php

namespace App\Repository;

use App\Entity\Sortiestock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sortiestock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortiestock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortiestock[]    findAll()
 * @method Sortiestock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortiestockRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sortiestock::class);
    }

    // /**
    //  * @return Sortiestock[] Returns an array of Sortiestock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sortiestock
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
