<?php

namespace App\Controller;

use App\Repository\ContainerRepository;
use App\Repository\PlantRepository;
use App\Repository\SeedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(
        PlantRepository $plantRepository,
        ContainerRepository $containerRepository,
        SeedRepository $seedRepository
    ): Response {
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
