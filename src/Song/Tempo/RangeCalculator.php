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

    /**
     * @var array
     */
    private $ranges;

    public function __construct(TempoRangeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function calculateRange(JazzStandard $standard): ?string
    {
        if (empty($this->ranges)) {
            $this->ranges = $this->repository->findAll();
        }

        foreach ($this->ranges as $range) {
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