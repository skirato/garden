<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Entity\Observation;
use App\Repository\ContainerRepository;
use App\Repository\ObservationRepository;
use App\Repository\PlantRepository;
use App\Repository\SeedRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlantController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/plant', name: 'app_plant', methods: ['POST'])]
    public function index(
        Request $request,
        PlantRepository $plantRepository,
        SeedRepository $seedRepository,
        ContainerRepository $containerRepository
    ): Response {
        $coords = (array)$request->request->get('coords');
        $positions = $this->getPositions($coords);

        foreach ($positions as $position) {
            $plant = new Plant();
            $plant->setSeed($seedRepository->find($request->request->get('seedId')))
                ->setContainer($containerRepository->find($request->request->get('containerId')))
                ->setQtySeedsPerSlot($request->request->get('seedsPerSlot'))
                ->setPosX($position[0])
                ->setPosY($position[1])
                ->setPlantedAt(new DateTimeImmutable($request->request->get('plantedAt')));

            $plantRepository->save($plant);
        }

        return new JsonResponse();
    }

    /**
     * @throws Exception
     */
    #[Route('/observe', name: 'app_observe', methods: ['POST'])]
    public function observe(
        Request $request,
        ObservationRepository $observationRepository,
        PlantRepository $plantRepository,
    ): Response {
        $parameters = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $observation = new Observation();
        $observation->setPlant($plantRepository->find($parameters['plantId']))
            ->setNote($parameters['note'])
            ->setSeverity($parameters['severity'])
            ->setObservedAt(new DateTimeImmutable($parameters['observedAt']));

        $observationRepository->save($observation, true);

        return new JsonResponse();
    }

    #[Route('/observations/{plantId}', name: 'app_observations', methods: ['GET'])]
    public function observations(
        int $plantId,
        ObservationRepository $observationRepository,
        PlantRepository $plantRepository
    ): Response {
        $observations = $observationRepository->findBy(['plant' => $plantRepository->find($plantId)],
            ['observedAt' => 'DESC']);

        return $this->json($observations);
    }

    /**
     * @throws JsonException
     */
    #[Route('/delete', name: 'app_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        EntityManagerInterface $entityManager,
        PlantRepository $plantRepository
    ): Response {
        $parameters = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        foreach ($parameters['plantIds'] as $plantId) {
            // todo add seeds
            $plantRepository->remove($plantRepository->find($plantId));
        }

        $entityManager->flush();

        return new JsonResponse();
    }

    private function getPositions(array $coords): array
    {
        $positions = [];
        for ($x = $coords[0][0]; $x <= $coords[1][0]; $x++) {
            for ($y = $coords[0][1]; $y <= $coords[1][1]; $y++) {
                $positions[] = [$x + 1, $y + 1];
            }
        }

        return $positions;
    }
}
