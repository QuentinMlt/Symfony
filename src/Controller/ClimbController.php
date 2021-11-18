<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClimbController extends AbstractController
{
    #[Route('/listClimb', name: 'listClimb')]
    public function list(): Response
    {
        return $this->render('climb/list.html.twig', [
            'controller_name' => 'ClimbController',
        ]);
    }

    #[Route('/detailClimb/{id}', name: 'detailClimb')]
    public function detail(): Response
    {
        return $this->render('climb/detail.html.twig', [
            'controller_name' => 'ClimbController',
        ]);
    }

    #[Route('/createClimb', name: 'createClimb')]
    public function creation(): Response
    {
        return $this->render('climb/create.html.twig', [
            'controller_name' => 'ClimbController',
        ]);
    }
}
