<?php

namespace App\Tests\Twig;

use App\Render\JazzStandardsTable\LinkGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LinkGeneratorTest extends KernelTestCase
{
    /**
     * @var LinkGeneratorExtension
     */
    private $linkGenerator;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->linkGenerator = $container->get(LinkGenerator::class);
    }

    public function testGetSearchFormatted()
    {
        $songName = "Take the 'A' train";

        $this->assertEquals(
            'take+the+a+train',
            $this->linkGenerator->getSearchFormatted(
                $songName
            )
        );
    }
}