<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Lecture;
use App\Repository\LectureRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('articleName')
            ->add('lecture',EntityType::class, [
                'placeholder' => 'Lecture',
                'class' => Lecture::class,
                'query_builder' => function(LectureRepository $repo){
                    return $repo->createLectureQueryBuilder();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
