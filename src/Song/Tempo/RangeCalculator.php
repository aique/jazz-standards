<?php

namespace App\Song\Tempo;

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

    public function calculateRange(JazzStandard $standard, array $ranges = []): ?string
    {
        if (empty($ranges)) {
            $ranges = $this->repository->findAll();
        }

        foreach ($ranges as $range) {
            if (!$range instanceof TempoRange) {
                continue;
            }

            if ($range->intoRange($standard->getTempo())) {
                return $range->getName();
            }
        }

        return null;
    }
}