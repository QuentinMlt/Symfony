<?php

namespace App\Controller;

use App\Form\CommentType;
use App\Repository\ClimbRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/detailClimb', name: 'createComment', methods: "POST")]
    public function creation( $id, Request $rq,RequestStack $request, CommentRepository $commentRepository, ClimbRepository $climbRepository): Response
    {
        
        $type = CommentType::class;
        $form = $this->createForm($type);
        $form->handleRequest($request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = $this->getUser();
            $climb = $climbRepository->find($id);
            $commentRepository->createComment($user, $climb, $data);
        }
        return $this->redirect("/detailClimb/$id");
    }
}
