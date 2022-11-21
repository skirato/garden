<?php

namespace App\Controller;


use App\Entity\Container;
use App\Entity\Plant;
use App\Entity\Seed;
use App\Repository\ContainerRepository;
use App\Repository\PlantRepository;
use App\Repository\SeedRepository;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(PlantRepository $plantRepository, ContainerRepository $containerRepository, SeedRepository $seedRepository): Response
    {
        $plants = $plantRepository->findAll();
        $containers = $containerRepository->findAll();
        $seeds = $seedRepository->findAll();

        $plantsSorted = [];
        foreach ($plants as $plant) {
            $plantsSorted[$plant->getContainer()->getId()][$plant->getPosX()][$plant->getPosY()] = $plant;
        }

        return $this->render('index/index.html.twig', [
            'plants' => $plantsSorted,
            'containers' => $containers,
            'seeds' => $seeds,
        ]);
    }
}
