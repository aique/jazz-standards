<?php

namespace App\Tests\Twig;

use App\Entity\JazzStandard;
use App\Tempo\RangeCalculator;
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
        $standard = new JazzStandard(
          '', '', '', '145', ''
        );

        $this->assertEquals(
            RangeCalculator::MEDIUM,
            $this->rangeCalculator->calculateRange(
                $standard
            )
        );

        $standard = new JazzStandard(
            '', '', '', '275', ''
        );

        $this->assertEquals(
            RangeCalculator::UP,
            $this->rangeCalculator->calculateRange(
                $standard
            )
        );

        $standard = new JazzStandard(
            '', '', '', '65', ''
        );

        $this->assertEquals(
            RangeCalculator::BALLAD,
            $this->rangeCalculator->calculateRange(
                $standard
            )
        );
    }
}