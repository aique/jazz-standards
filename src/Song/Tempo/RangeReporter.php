<?php

namespace App\Song\Tempo;

use App\Entity\TempoRange;
use App\Repository\TempoRangeRepository;

class RangeReporter
{
    private $repository;

    public function __construct(TempoRangeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function report(): string
    {
        $report = '';

        $ranges = $this->repository->findAll();

        foreach ($ranges as $range) {
            if (!$range instanceof TempoRange) {
                continue;
            }

            $report .= sprintf(
                '<p><b>%s:</b> %s - %s</p>',
                $range->getName(),
                $range->getStart(),
                empty($range->getEnd()) ? '&infin;' : $range->getEnd()
            );
        }

        return $report;
    }
}