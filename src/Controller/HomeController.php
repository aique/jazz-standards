<?php

namespace App\Controller;

use App\Entity\JazzStandard;
use App\Entity\TempoRange;
use App\Song\Genre\GenreReporter;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var GenreReporter
     */
    private $genreReporter;

    public function __construct(
        EntityManagerInterface $manager,
        GenreReporter $genreReporter
    ) {
        $this->manager = $manager;
        $this->genreReporter = $genreReporter;
    }

    /**
     * @Route("/")
     */
    public function home(): Response
    {
        $repository = $this->manager->getRepository(JazzStandard::class);
        $standards = $repository->findAll();

        $repository = $this->manager->getRepository(TempoRange::class);
        $ranges = $repository->findAll();

        $genres = $this->genreReporter->getAllGenres();

        $parameters = [
            'standards' => $standards,
            'ranges' => $ranges,
            'genres' => $genres,
        ];

        return $this->render('home/home.html.twig', $parameters);
    }
}