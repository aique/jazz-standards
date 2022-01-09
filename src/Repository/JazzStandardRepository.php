<?php

namespace App\Repository;

use App\Entity\JazzStandard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class JazzStandardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JazzStandard::class);
    }

    public function findAllGenres(): array {
        return $this->createQueryBuilder('tr')
            ->select('tr.genres')
            ->distinct()
            ->getQuery()
            ->getSingleColumnResult()
        ;
    }
}