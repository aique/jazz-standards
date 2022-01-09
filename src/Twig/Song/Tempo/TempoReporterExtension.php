<?php

namespace App\Twig\Song\Tempo;

use App\Song\Tempo\RangeReporter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TempoReporterExtension extends AbstractExtension
{
    /**
     * @var RangeReporter
     */
    private $rangeReporter;

    public function __construct(RangeReporter $rangeReporter)
    {
        $this->rangeReporter = $rangeReporter;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('tempo_range_report', [$this->rangeReporter, 'report']),
        ];
    }
}