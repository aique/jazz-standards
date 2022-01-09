<?php

namespace App\Twig\Render;

use App\Render\JazzStandardsTable\LinkGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LinkGeneratorExtension extends AbstractExtension
{
    /**
     * @var LinkGenerator
     */
    private $linkGenerator;

    public function __construct(LinkGenerator $linkGenerator)
    {
        $this->linkGenerator = $linkGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('tab_href', [$this->linkGenerator, 'getTabHref'])
        ];
    }
}