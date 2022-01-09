<?php

namespace App\Song\Genre;

use App\Repository\JazzStandardRepository;

class GenreReporter
{
    /**
     * @var JazzStandardRepository
     */
    private $repository;

    public function __construct(JazzStandardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllGenres(): array
    {
        $uniqueGenres = [];

        $genres = $this->repository->findAllGenres();

        foreach ($genres as $genre) {
            $currentGenres = explode(',', $genre);

            foreach ($currentGenres as $currentGenre) {
                if (!in_array($currentGenre, $uniqueGenres)) {
                    $uniqueGenres[] = $currentGenre;
                }
            }
        }

        return $uniqueGenres;
    }
}