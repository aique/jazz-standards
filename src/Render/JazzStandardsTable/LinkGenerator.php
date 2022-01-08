<?php

namespace App\Render\JazzStandardsTable;

class LinkGenerator
{
    const SEARCH_PLACEHOLDER = 'https://www.google.com/search?q=%s+tab+piano&tbm=isch';

    public function getTabHref(string $songName) {
        return sprintf(self::SEARCH_PLACEHOLDER, $this->getSearchFormatted($songName));
    }

    public function getSearchFormatted(string $songName): string
    {
        $songName = strtolower($songName);
        $songName = preg_replace('/[\']/', '', $songName);
        $songName = str_replace(' ', '+', $songName);

        return $songName;
    }
}