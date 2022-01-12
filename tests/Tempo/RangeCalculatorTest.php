<?php

namespace App\Tests\Render;

use App\Entity\JazzStandard;
use App\Entity\TempoRange;
use App\Song\Tempo\RangeCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RangeCalculatorTest extends KernelTestCase
{
    /**
     * @var RangeCalculator
     */
    private $rangeCalculator;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->rangeCalculator = $container->get(RangeCalculator::class);
    }

    public function testGetSearchFormatted()
    {
        $this->assertEquals(
            TempoRange::BALLAD,
            $this->rangeCalculator->calculateRange(
                $this->createJazzStandard('65')
            )
        );

        $this->assertEquals(
            TempoRange::BALLAD,
            $this->rangeCalculator->calculateRange(
                $this->createJazzStandard('85')
            )
        );

        $this->assertEquals(
            TempoRange::SLOW_MEDIUM,
            $this->rangeCalculator->calculateRange(
                $this->createJazzStandard('86')
            )
        );

        $this->assertEquals(
            TempoRange::MEDIUM,
            $this->rangeCalculator->calculateRange(
                $this->createJazzStandard('145')
            )
        );

        $this->assertEquals(
            TempoRange::FAST_MEDIUM,
            $this->rangeCalculator->calculateRange(
                $this->createJazzStandard('245')
            )
        );

        $this->assertEquals(
            TempoRange::UP,
            $this->rangeCalculator->calculateRange(
                $this->createJazzStandard('246')
            )
        );

        $this->assertEquals(
            TempoRange::UP,
            $this->rangeCalculator->calculateRange(
                $this->createJazzStandard('315')
            )
        );
    }

    private function createJazzStandard(string $tempo): JazzStandard
    {
        return new JazzStandard(
            '', '', '', '', '', $tempo, ''
        );
    }
}