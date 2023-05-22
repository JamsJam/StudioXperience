<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Format;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;

use App\EventSubscriber\PostFormSubscriber;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PostType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pricing',ChoiceType::class,[
                'label' => 'payant',
                'attr' => [
                    'placeholder' => 'payant'
                
                    ],
                "expanded" => true,
                "multiple" => false,
                'choices' => [
                    'oui' => true,
                    'non' => false
                ],
                'required' => false,
            ])
            ->add('share',ChoiceType::class,[
                'label' => 'Partage',
                'attr' => [
                    'placeholder' => 'Partage'
                ],
                "expanded" => true,
                "multiple" => false,
                'choices' => [
                    'oui' => true,
                    'non' => false
                ],
                'required' => false,
            ])
            ->add('titre',TextType::class,[
                "label" => "Titre",
            ])
            //! Utilisera un module WYSIWYG pour l'éditeur de texte via TinyMCE
            ->add('corps',TextareaType::class, [
                "required" => false,
                // "attr" => [
                //             "plugins" =>  
                //                 'advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template paste help codesample a11ychecker '
                //             ,

                //             "toolbar"=> 'undo redo | styleselect | bold italic copy paste | outdent indent | table image | emoticons visualchars code | numlist bullist anchor link | preview codesample',
                            
                //             "image_title"=>true,
                            
                //             "menubar"=>"file edit view insert format tools help",
                //     ]
            ]) 
            ->addEventSubscriber( new PostFormSubscriber()) 
           
            ->add('description',TextType::class,[
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description'
                ]
            ])
            ->add('keywords',TextType::class,[
                'label' => 'Mots clés',
                'attr' => [
                    'placeholder' => 'Mots clés'
                ]
            ])
            ->add('publishAt',DateTimeType::class,[
                'widget' => 'single_text',
                'label' => 'Date de publication',
                'attr' => [
                    'placeholder' => 'Date de publication'
                ],
                'mapped' => false,
            ])
            ->add('format',EntityType::class,[
                'class' => Format::class,
                'choice_label' => 'nom',
                'label' => 'Format',
                'attr' => [
                    'placeholder' => 'Format'
                ],
                'multiple' => false,  // Permet de sélectionner plusieurs catégories
                'expanded' => true,  // Affiche les options comme des radios
            ])
            ->add('categorie',EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'multiple' => true,  // Permet de sélectionner plusieurs catégories
                'expanded' => true,  // Affiche les options comme des checkboxes
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
