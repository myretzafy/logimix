<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation')
            ->add('prix')
            ->add('photo',FileType::class,[
               'required'=>false,
               'mapped'=>false])
            ->add('category',EntityType::class,[
                'class'=>Category::class,
                'choice_label'=>'categorie',
                'required'=>true
            ])
            ->add('pointure',ChoiceType::class,[
             'choices'=>$this->getstringpointure()  
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
    private function getstringpointure()
    {
          
            $pointures= Article::point;
            $resultat=[];
            foreach($pointures as $k=>$v){
                  $resultat[$v]=$k;
            }
            return $resultat;
    }
}
