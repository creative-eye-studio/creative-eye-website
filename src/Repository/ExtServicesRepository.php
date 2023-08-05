<?php

namespace App\Repository;

use App\Entity\ExtServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExtServices>
 *
 * @method ExtServices|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExtServices|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExtServices[]    findAll()
 * @method ExtServices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtServicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExtServices::class);
    }

//    /**
//     * @return ExtServices[] Returns an array of ExtServices objects
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

//    public function findOneBySomeField($value): ?ExtServices
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
