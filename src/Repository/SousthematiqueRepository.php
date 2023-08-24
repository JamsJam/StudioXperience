<?php

namespace App\Repository;

use App\Entity\Sousthematique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sousthematique>
 *
 * @method Sousthematique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sousthematique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sousthematique[]    findAll()
 * @method Sousthematique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousthematiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sousthematique::class);
    }

//    /**
//     * @return Sousthematique[] Returns an array of Sousthematique objects
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

//    public function findOneBySomeField($value): ?Sousthematique
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
