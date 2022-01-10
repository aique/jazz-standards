<?php

namespace App\DataFixtures;

use App\Entity\TempoRange;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TempoRangesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $balladRange = new TempoRange(
            TempoRange::BALLAD, 0, 85
        );

        $slowMediumRange = new TempoRange(
            TempoRange::SLOW_MEDIUM, 86, 138
        );

        $mediumRange = new TempoRange(
            TempoRange::MEDIUM, 139, 191
        );

        $fastMediumRange = new TempoRange(
            TempoRange::FAST_MEDIUM, 192, 245
        );

        $upRange = new TempoRange(
            TempoRange::UP, 246
        );

        $manager->persist($balladRange);
        $manager->persist($slowMediumRange);
        $manager->persist($mediumRange);
        $manager->persist($fastMediumRange);
        $manager->persist($upRange);

        $manager->flush();
    }
}