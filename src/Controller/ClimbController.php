<?php

namespace App\Controller;

use App\Form\ClimbCreateType;
use App\Form\CommentType;
use App\Repository\ClimbRepository;
use App\Repository\CommentRepository;
use App\Repository\ParticipantRepository;
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

    #[Route('/detailClimb/{id}', name: 'detailClimb', methods: "GET")]
    public function detail($id, ClimbRepository $climbRepository, CommentRepository $commentRepository): Response
    {
        $climb = $climbRepository->find($id);
        $type = CommentType::class;
        $form = $this->createForm($type);
        //dd($commentRepository->findCommentByClimb($id)->getResult());
        return $this->render('climb/detail.html.twig', [
            'controller_name' => 'ClimbController',
            'climb' => $climb,
            'comments' => $commentRepository->findCommentByClimb($id)->getResult(),
            'form' => $form->createView()
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
    
    #[Route('/participateEvent/{id}', name: 'participateEvent', methods: "GET")]
    public function Participate($id,Request $request, ClimbRepository $climbRepo, ParticipantRepository $participant): Response
    {
        
        $user = $this->getUser();
        $climb = $climbRepo->find($id);
        $participant->Participate($user,$climb);
        return $this->redirect("/detailClimb/$id");
    }
}

