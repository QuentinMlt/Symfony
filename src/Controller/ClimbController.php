<?php

namespace App\Controller;

use App\Repository\ClimbRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClimbController extends AbstractController
{   
    public function __construct(private ClimbRepository $climbRepository)
    {
        
    }


    #[Route('/listClimb', name: 'listClimb')]
    public function list(): Response
    {
        return $this->render('climb/list.html.twig', [
            'controller_name' => 'ClimbController',
            'climbs' =>  $this->climbRepository->listClimb()->getResult()
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
