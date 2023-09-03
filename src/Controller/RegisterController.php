<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/inscription', name: 'app_register')]
    public function index(ManagerRegistry $doctrine,Request $request,UserPasswordHasherInterface $encoder): Response
    {
        $user= new User();
        $form=$this->createForm(RegisterType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $user=$form->getData();
            $password=$encoder->hashPassword($user,$user->getPassword());
            $user->setPassword($password);
            $manager=$this->doctrine->getManager();
            $manager->persist($user);
            $manager->flush();

        }

        return $this->render('register/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
