<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profile/{id}', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/rank', name: 'rank')]
    public function index(): Response
    {
        return $this->render('user/rank.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
