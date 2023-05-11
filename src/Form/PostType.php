<?php

namespace App\Form;

use App\Entity\Post;
use DateTimeImmutable;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use phpDocumentor\Reflection\Types\Boolean;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pricing',RadioType::class,[
                'label' => 'payant',
                'attr' => [
                    'placeholder' => 'payant'
                ]
            ])
            ->add('share',RadioType::class,[
                'label' => 'Partage',
                'attr' => [
                    'placeholder' => 'Partage'
                ]
            ])
            ->add('titre',TextType::class,[
                "label" => "Titre",
            ])
            //! Utilisera un module WYSIWYG pour l'éditeur de texte via TinyMCE
            ->add('corps',TinymceType::class, [
                "attr" => [
                    "toolbar" => "bold italic underline | bullist numlist",
                ],
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
            ->add('publishAt',DateTimeImmutable::class,[
                'widget' => 'single_text',
                'label' => 'Date de publication',
                'attr' => [
                    'placeholder' => 'Date de publication'
                ]
            ])
            ->add('format',EntityType::class,[
                'class' => 'App\Entity\Format',
                'choice_label' => 'nom',
                'label' => 'Format',
                'attr' => [
                    'placeholder' => 'Format'
                ]
            ])
            ->add('categorie',EntityType::class,[
                'class' => 'App\Entity\Categorie',
                'choice_label' => 'nom',
                'label' => 'Catégorie',
                'attr' => [
                    'placeholder' => 'Catégorie'
                ]
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
