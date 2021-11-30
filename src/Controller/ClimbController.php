<?php

namespace App\Controller;

use App\Repository\ClimbRepository;
use App\Repository\CommentRepository;
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
    public function detail($id, ClimbRepository $climbRepository, CommentRepository $commentRepository): Response
    {
        $climb = $climbRepository->find($id);
        //dd($commentRepository->findCommentByClimb($id)->getResult());
        return $this->render('climb/detail.html.twig', [
            'controller_name' => 'ClimbController',
            'climb' => $climb,
            'comments' => $commentRepository->findCommentByClimb($id)->getResult()
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
