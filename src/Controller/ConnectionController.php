<?php

namespace App\Controller;

use App\Form\LoginFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnectionController extends AbstractController
{
    /*
    #[Route('/login', name: 'login')]
    public function login(RequestStack $request, UserRepository $userRepo): Response
    {
        $type = LoginFormType::class;
        $form = $this->createForm($type);
        if ($request->getCurrentRequest()->isMethod('POST')) {
            $form->handleRequest($request->getCurrentRequest());
            if ($form->isSubmitted() && $form->isValid()) {
                $user = $userRepo->loginUser($form->getData()['email'],$form->getData()['password'])->getResult();
                if (count($user) === 1) {
                    return$this->redirectToRoute('home');
                }
            }
        }
        return $this->render('connection/login.html.twig', [
            'controller_name' => 'ConnectionController',
            'form' => $form->createView()
        ]);
    }
    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('connection/register.html.twig', [
            'controller_name' => 'ConnectionController',
        ]);
    }
*/
    /*#[Route('/login', name: "postLogin")]
    public function postLogin():Response
    {
        return $this->render('connection/register.html.twig', [
            'controller_name' => 'ConnectionController',
        ]);
    }*/
}
