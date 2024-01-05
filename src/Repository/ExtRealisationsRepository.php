<?php

namespace App\Repository;

use App\Entity\ExtRealisations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExtRealisations>
 *
 * @method ExtRealisations|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExtRealisations|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExtRealisations[]    findAll()
 * @method ExtRealisations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtRealisationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExtRealisations::class);
    }

//    /**
//     * @return ExtRealisations[] Returns an array of ExtRealisations objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExtRealisations
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
