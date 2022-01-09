<?php

namespace App\Controller;

use App\Entity\JazzStandard;
use App\Entity\TempoRange;
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

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
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

        $parameters = [
            'standards' => $standards,
            'ranges' => $ranges,
        ];

        return $this->render('home/home.html.twig', $parameters);
    }
}