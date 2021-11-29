<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    public function __construct(private UserRepository $userRepository)
    {
        
    }

    #[Route('/profile/{id}', name: 'profile')]
    public function profile($id, RequestStack $request, UserRepository $userRepo): Response
    {
        $userAuth = $this->getUser();
        $boolAuth = $this->isGranted('IS_AUTHENTICATED_FULLY');
        $user = $userRepo->find($id);
        $type = ProfileFormType::class;
        $form = $this->createForm($type);

        if ($request->getCurrentRequest()->isMethod('POST')) {
            $form->handleRequest($request->getCurrentRequest());
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $userRepo->updateUser($id, $data);
            }
        }
        return $this->render('user/profile.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'form' => $form->createView(),
            'userAuth' => $userAuth,
            'boolAuth' => $boolAuth
        ]);
    }

    #[Route('/rank', name: 'rank')]
    public function index(): Response
    {
        // dd($this->userRepository->rankUsers()->getResult());
        return $this->render('user/rank.html.twig', [
            'controller_name' => 'UserController',
            'users' => $this->userRepository->rankUsers()->getResult()
        ]);
    }
}
