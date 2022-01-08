<?php

namespace App\Tempo;

use App\Entity\JazzStandard;

class RangeCalculator
{
    const BALLAD = 'Ballad';
    const MEDIUM = 'Medium';
    const UP = 'Up';

    const RANGES = [
        self::BALLAD,
        self::MEDIUM,
        self::UP,
    ];

    public function calculateRange(JazzStandard $standard): string
    {
        if ($standard->getTempo() <= 85) {
            return self::BALLAD;
        } else if ($standard->getTempo() >= 245) {
            return self::UP;
        }

        return self::MEDIUM;
    }
}