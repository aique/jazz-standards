<?php

namespace App\Controller;

use App\Entity\JazzStandard;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
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

        $parameters = [
            'standards' => $standards,
        ];

        return $this->render('home.html.twig', $parameters);
    }
}