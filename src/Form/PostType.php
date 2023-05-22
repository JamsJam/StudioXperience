<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Format;
use App\Entity\Categorie;
use GuzzleHttp\Psr7\Request;

use Symfony\Component\Form\AbstractType;
use App\EventSubscriber\PostFormSubscriber;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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

        $format = $options['format'];
        
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

            ->add('categorie',EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'multiple' => true,  // Permet de sélectionner plusieurs catégories
                'expanded' => true,  // Affiche les options comme des checkboxes
                
            ])
            
            ->addEventSubscriber( new PostFormSubscriber());

    //?  =========================================================================
    //*             Champs selon le format du post
    //?  =========================================================================

        if($format == "Video"){
            $builder
            //! utiliser un module de type "file" pour l'upload de la vidéo
                ->add('video',FileType::class,[
                    'label' => 'Video',
                    'attr' => [
                        // 'placeholder' => 'Video'
                    ],
                    "mapped" => false,
                ])
                ->add('Transcription',TextareaType::class,[
                    'label' => 'Video',
                    'attr' => [
                        'placeholder' => 'transcription'
                    ],
                    "mapped" => false,
                ]);
        }


        if($format == "Article"){

            $builder
            //! Utilisera un module WYSIWYG pour l'éditeur de texte via TinyMCE
                ->add('corps',TextareaType::class, [
                    "required" => false,
                ]); 
        }


        if($format == "Audio"){

            $builder
                ->add('audio',FileType::class,[
                    'label' => 'Audio',
                    'attr' => [
                        'placeholder' => 'Audio'
                    ],
                    'mapped' => false,
                ])
                ->add('Transcription',TextareaType::class,[
                    'label' => 'transcription',
                    'attr' => [
                        'placeholder' => 'transcription'
                    ],
                    "mapped" => false,
                ]);
        }

    //?  =========================================================================

    }




    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,

            'format' => null,
        ]);
    }
}
