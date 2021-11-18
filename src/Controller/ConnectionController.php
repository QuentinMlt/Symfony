<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnectionController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('connection/login.html.twig', [
            'controller_name' => 'ConnectionController',
        ]);
    }
    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('conntection/register.html.twig', [
            'controller_name' => 'ConnectionController',
        ]);
    }
}
