<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlantController extends AbstractController
{
    #[Route('/plant', name: 'app_plant')]
    public function index(): Response
    {
        return $this->render('plant/index.html.twig', [
            'controller_name' => 'PlantController',
        ]);
    }
}
