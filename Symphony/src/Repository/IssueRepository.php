<?php

namespace App\Repository;

use App\Entity\Issue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Issue>
 */
class IssueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Issue::class);
    }

    //    /**
    //     * @return Issue[] Returns an array of Issue objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Issue
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByFilters(array $filters, int $page, int $limit): array
    {
        $qb = $this->createQueryBuilder('i');

        if (!empty($filters['id'])) {
            $qb->andWhere('i.id = :id')
                ->setParameter('id', $filters['id']);
        }

        if (!empty($filters['issuedAt'])) {
            $date = new \DateTime($filters['issuedAt']);
            $startOfDay = $date->format('Y-m-d');
            $endOfDay = $date->add(new \DateInterval('P1D'))->format('Y-m-d');

            $qb->andWhere('i.IssuedAt BETWEEN :startOfDay AND :endOfDay')
                ->setParameter('startOfDay', $startOfDay)
                ->setParameter('endOfDay', $endOfDay);
        }

        $countQb = clone $qb;
        $countQb->select('COUNT(i.id)');
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
