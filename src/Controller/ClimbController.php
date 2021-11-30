<?php

namespace App\Controller;

use App\Form\ClimbCreateType;
use App\Repository\ClimbRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
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

    #[Route('/createClimb', name: 'createClimb', methods: "GET")]
    public function creation(): Response
    {
        $type = ClimbCreateType::class;
        $form = $this->createForm($type);
        return $this->render('climb/create.html.twig', [
            'controller_name' => 'ClimbController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/createClimb', name: 'createClimbPost', methods: "POST")]
    public function creationPost(RequestStack $request, ClimbRepository $climbRepo): Response
    {
        $type = ClimbCreateType::class;
        $form = $this->createForm($type);
        $form->handleRequest($request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = $this->getUser();
            $climbRepo->createClimb($user, $data);
        }
        return $this->redirectToRoute('listClimb');
    }
}
