<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use App\Form\UserType;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use App\Service\Uploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/article", name="admin_article")
     */
    
    public function index(ArticleRepository $article): Response
    {
        return $this->render('admin/article/index.html.twig', ['articles'=>$article->findAll()]) ;
    }

     /**
     * @Route("/admin/article/edit/{id}", name="admin_article_edit")
     */
    public function editart(Article $article,Request $req,EntityManagerInterface $manager,Uploader $uploader): Response
    {
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
              $file=$form['photo']->getData();
             if($file){
                $filename=$uploader->uploading($file);
                $article->setPhoto($filename);
             }
                  $this->addFlash('success','Vous avez modifier l\'article avec succee') ;   
              $manager->flush();
              return $this->redirectToRoute('admin_article');

        }
        return $this->render('admin/article/edit.html.twig',['form'=>$form->createView()] ) ;
    }


     /**
     * @Route("/admin/article/new", name="admin_article_new")
     */
    public function newart(Request $req,EntityManagerInterface $manager,Uploader $uploader): Response
    {
       $article=new Article();
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
              $file=$form['photo']->getData();
             if($file){
                $filename=$uploader->uploading($file);
                 $article->setPhoto($filename);
             }
               $manager->persist($article);  
               $this->addFlash('success','Vous avez bien ajouté(e) l\'article ') ;     
              $manager->flush();
              return $this->redirectToRoute('admin_article');

        }
        return $this->render('admin/article/edit.html.twig',['form'=>$form->createView()] ) ;
    }

     /**
     * @Route("/admin/article/delete/{id}", name="admin_article_delete")
     */
    public function delart(Article $article,EntityManagerInterface $manager,Request $request): Response
    {
             
         if($this->isCsrfTokenValid('delete'. $article->getId(),$request->get('_token'))){

             $manager->remove($article);             
              $manager->flush();
         }
       
            return $this->redirectToRoute('admin_article');
    }


     /**
     * @Route("/admin/user", name="admin_user")
     */
    public function userlist(UserRepository $users): Response
    {
           return $this->render('admin/user/alluser.html.twig',['users'=>$users->findAll()]);
    }

     /**
     * @Route("/admin/user/edit/{id}", name="admin_user_edit")
     */
    public function useredit(User $users,Request $req, EntityManagerInterface $manag): Response
    {
        $form=$this->createForm(UserType::class,$users);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid())
        {
             $manag->flush();
             return $this->redirectToRoute('admin_user');
        
        }
        return $this->render('admin/user/edituser.html.twig',['form'=>$form->createView()]);
    }
}

