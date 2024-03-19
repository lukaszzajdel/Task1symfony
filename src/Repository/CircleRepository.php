<?php

namespace App\Repository;

use App\Entity\Circle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Circle>
 *
 * @method Circle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Circle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Circle[]    findAll()
 * @method Circle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CircleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Circle::class);
    }

    public function save(Circle $circle)
    {
        $this->getEntityManager()->persist($circle);
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return Circle[] Returns an array of Circle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Circle
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
