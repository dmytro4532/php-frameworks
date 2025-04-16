<?php

namespace App\Repository;

use App\Entity\Reader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reader>
 */
class ReaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reader::class);
    }

    //    /**
    //     * @return Reader[] Returns an array of Reader objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Reader
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByFilters(array $filters, int $page, int $limit): array
    {
        $qb = $this->createQueryBuilder('r');

        if (!empty($filters['id'])) {
            $qb->andWhere('r.id = :id')
                ->setParameter('id', $filters['id']);
        }

        if (!empty($filters['fullName'])) {
            $qb->andWhere('r.fullName LIKE :fullName')
                ->setParameter('fullName', '%' . $filters['fullName'] . '%');
        }

        if (!empty($filters['email'])) {
            $qb->andWhere('r.email LIKE :email')
                ->setParameter('email', '%' . $filters['email'] . '%');
        }

        $countQb = clone $qb;
        $countQb->select('COUNT(r.id)');
        $totalItems = (int) $countQb->getQuery()->getSingleScalarResult();

        $qb->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        $items = $qb->getQuery()->getResult();
        $totalPages = max(1, ceil($totalItems / $limit));

        return [
            'items' => $items,
            'totalPages' => $totalPages,
        ];
    }
}
