<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JazzStandardsFixtures extends Fixture
{
    /**
     * @var QuickReferenceReader
     */
    private $reader;

    public function __construct(QuickReferenceReader $reader)
    {
        $this->reader = $reader;
    }

    public function load(ObjectManager $manager): void
    {
        while(!empty($standard = $this->reader->next())) {
            $manager->persist($standard);
        }

        $manager->flush();
    }
}
