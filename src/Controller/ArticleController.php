<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_article")
     */
    public function index(ArticleRepository $articles): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' =>$articles->findAll() ,
        ]);
    }

    /**
     * @Route("/article/{slug}-{id}", name="app_article_show", requirements={"slug":"[a-z0-9\-]*"})
     */
    public function show(Article $article,Request $req){
       $contact= new Contact();
        $formcontact=$this->createForm(ContactType::class,$contact);
        $formcontact->handleRequest($req);
       
        
        if ($formcontact->isSubmitted() && $formcontact->isValid()){
            $contact->setArticle($article);
        ///      emailsender->mailing();
             return new Response('detail avec contact');
          }
            return $this->render('article/showarticle.html.twig',['article'=>$article,
                                                                  'form'=>$formcontact->createView()
        ]);
    }
}
