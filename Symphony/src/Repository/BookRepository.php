<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByFilters(array $filters, int $page, int $limit): array
    {
        $qb = $this->createQueryBuilder('b');

        if (!empty($filters['id'])) {
            $qb->andWhere('b.id = :id')
                ->setParameter('id', $filters['id']);
        }

        if (!empty($filters['title'])) {
            $qb->andWhere('b.title LIKE :title')
                ->setParameter('title', '%' . $filters['title'] . '%');
        }

        $countQb = clone $qb;
        $countQb->select('COUNT(b.id)');
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
