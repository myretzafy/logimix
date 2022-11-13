<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/user/new", name="app_user_add")
     */
    public function adduser(Request $req,EntityManagerInterface $manag,UserPasswordEncoderInterface $encoder): Response
    {
         $users=new User();
        $form=$this->createForm(UserType::class,$users); 
         $form->handleRequest($req);
         if ($form->isSubmitted() && $form->isValid()){
            $pass=$users->getPassword();
           $hashpass= $encoder->encodePassword($users,$pass);
           $users->setPassword($hashpass);
            $manag->persist($users);
            $manag->flush();
           
            return $this->redirectToRoute('app_article');

         } 
        return $this->render('user/useradd.html.twig',['form'=>$form->createView()] );
    }

/**
     * @Route("/api/user", name="app_user_api", methods="GET")
     */
    public function getU(UserRepository $userRepo): Response
    {
             $users=$userRepo->findAll();
             $jsonUser=$this->json($users,201,[]);
        return  $jsonUser;
    }
      


    /**
     * @Route("/user/login", name="app_user_login")
     */
    public function sinIh(AuthenticationUtils $auth): Response
    {
            
        return  $this->render('user/login.html.twig',['lastuser'=>$auth->getLastUsername(),
                                                      'error'=>$auth->getLastAuthenticationError()]);
    }

     /**
     * @Route("/user/logout", name="app_user_logout")
     */
    public function sinOut()
    {
        
    }
}
