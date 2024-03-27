<?php

namespace App\Repository;

use App\Entity\Square;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Square>
 *
 * @method Square|null find($id, $lockMode = null, $lockVersion = null)
 * @method Square|null findOneBy(array $criteria, array $orderBy = null)
 * @method Square[]    findAll()
 * @method Square[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SquareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Square::class);
    }
    public function save(Square $square)
    {
        $this->getEntityManager()->persist($square);
        $this->getEntityManager()->flush();
    }
    public function delete(Square $square)
    {
        $this->getEntityManager()->remove($square);
        $this->getEntityManager()->flush();
    }
    //    /**
    //     * @return Square[] Returns an array of Square objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    // public function findOneById(int $id): ?Square
    // {
    //     return $this->createQueryBuilder('s')
    //         ->andWhere('s.id = :val')
    //         ->setParameter('val', $id)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }
}
