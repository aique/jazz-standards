<?php

namespace App\Tempo;

use App\Entity\JazzStandard;
use App\Entity\TempoRange;
use App\Repository\TempoRangeRepository;

class RangeCalculator
{
    /**
     * @var TempoRangeRepository
     */
    private $repository;

    public function __construct(TempoRangeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function calculateRange(JazzStandard $standard): ?string
    {
        $range = $this->repository->getRangeByTempo($standard->getTempo());

        if ($range instanceof TempoRange) {
            return $range->getName();
        }

        return null;
    }
}