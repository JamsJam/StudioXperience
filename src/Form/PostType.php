<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Type;
use App\Entity\Thematique;
use App\Entity\Sousthematique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type',EntityType::class,[
                'class' => Type::class,
                'choice_label' => 'name',
                "attr" => [
                    "class" => "input__text"
                ],
                "label_attr" => [
                    "class" => "text text--20-400"
                ]
            ])

            ->add('thematique',EntityType::class,[
                'class' =>  Thematique::class,
                'choice_label' => 'theme',
                "attr" => [
                    "class" => "input__text"
                ],
                "label_attr" => [
                    "class" => "text text--20-400"
                ]
            ])
            
            ->add('sousThematiques', EntityType::class,[
                'class' => Sousthematique::class,
                'choice_label' => 'sousTheme',
                'multiple' => true,
                'expanded' => true,
                // "attr" => [
                //     "class" => "input__checkbox"
                // ],
                "label_attr" => [
                    "class" => "text text--20-400"
                ]
                    ])

            ->add('title',TextType::class,[
                "attr" => [
                    "class" => "input__text",
                    "data-preview-target"=>'titre',
                    "data-action" => "preview#changeTitle"
                ],
                "label_attr" => [
                    "class" => "text text--20-400"
                ]
            ])

            ->add('description',TextareaType::class,[
                "attr" => [
                    "class" => "input__textarea",
                    "data-preview-target"=>'description',
                    "data-action" => "preview#changeDescription"
                ],
                "label_attr" => [
                    "class" => "text text--20-400"
                ]
            ])

            // ->add('poster')
            ->add('publishAt')
            // ->add('editAt')
            // ->add('createdAt')
            ->add('content')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
