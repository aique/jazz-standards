<?php

namespace App\Repository;

use App\Entity\TempoRange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TempoRangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TempoRange::class);
    }

    public function getRangeByTempo(string $tempo): ?TempoRange
    {
        return $this->createQueryBuilder('tr')
            ->where('tr.start <= :tempo')
            ->where('tr.end > :tempo OR tr.end IS NULL')
            ->setParameter('tempo', $tempo)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}