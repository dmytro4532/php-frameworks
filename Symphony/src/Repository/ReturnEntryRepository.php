<?php

namespace App\Repository;

use App\Entity\ReturnEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReturnEntry>
 */
class ReturnEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReturnEntry::class);
    }

    //    /**
    //     * @return ReturnEntry[] Returns an array of ReturnEntry objects
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

    //    public function findOneBySomeField($value): ?ReturnEntry
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

        if (!empty($filters['returnedAt'])) {
            $date = new \DateTime($filters['returnedAt']);
            $startOfDay = $date->format('Y-m-d');
            $endOfDay = $date->add(new \DateInterval('P1D'))->format('Y-m-d');

            $qb->andWhere('r.returnedAt BETWEEN :startOfDay AND :endOfDay')
                ->setParameter('startOfDay', $startOfDay)
                ->setParameter('endOfDay', $endOfDay);
        }

        $countQb = clone $qb;
        $countQb->select('COUNT(r.id)');
        $totalItems = (int)$countQb->getQuery()->getSingleScalarResult();

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
