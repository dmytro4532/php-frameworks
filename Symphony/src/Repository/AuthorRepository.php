<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByFilters(array $filters, int $page, int $limit): array
    {
        $qb = $this->createQueryBuilder('a');

        if (!empty($filters['id'])) {
            $qb->andWhere('a.id = :id')
                ->setParameter('id', $filters['id']);
        }

        if (!empty($filters['fullName'])) {
            $qb->andWhere('a.fullName LIKE :fullName')
                ->setParameter('fullName', '%' . $filters['fullName'] . '%');
        }

        $countQb = clone $qb;
        $countQb->select('COUNT(a.id)');
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
