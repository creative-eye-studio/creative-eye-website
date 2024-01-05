<?php

namespace App\Repository;

use App\Entity\ExtRealisationsImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExtRealisationsImages>
 *
 * @method ExtRealisationsImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExtRealisationsImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExtRealisationsImages[]    findAll()
 * @method ExtRealisationsImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtRealisationsImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExtRealisationsImages::class);
    }

//    /**
//     * @return ExtRealisationsImages[] Returns an array of ExtRealisationsImages objects
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

//    public function findOneBySomeField($value): ?ExtRealisationsImages
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
