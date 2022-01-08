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

        $mediumRange = new TempoRange(
            TempoRange::MEDIUM, 86, 245
        );

        $upRange = new TempoRange(
            TempoRange::UP, 246
        );

        $manager->persist($balladRange);
        $manager->persist($mediumRange);
        $manager->persist($upRange);

        $manager->flush();
    }
}