<?php

namespace App\Twig\Song\Tempo;

use App\Song\Tempo\RangeCalculator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TempoCalculatorExtension extends AbstractExtension
{
    /**
     * @var RangeCalculator
     */
    private $rangeCalculator;

    public function __construct(RangeCalculator $rangeCalculator)
    {
        $this->rangeCalculator = $rangeCalculator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('calculate_range', [$this->rangeCalculator, 'calculateRange']),
        ];
    }
}