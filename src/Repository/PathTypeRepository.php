<?php

namespace App\Repository;

use App\Entity\PathType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PathType>
 *
 * @method PathType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PathType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PathType[]    findAll()
 * @method PathType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PathTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PathType::class);
    }

//    /**
//     * @return PathType[] Returns an array of PathType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PathType
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
