<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class TranslationService
{
    private EntityManagerInterface $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Traduis un article dans une langue donnée et l'ajoute à la base de données
     * @param int $postId The article id
     * @param string $translatedTitle The translated title
     * @param string|null $translatedContent The translated content
     * @param string $locale The locale to translate to
     * @return void
     */
    public function addTranslationToArticle(int $postId, string $translatedTitle, string $translatedContent = null, string $locale = 'en_US'): void
    {
        //? get the article instance ====================

        $article = $this->entityManager->getRepository(Post::class)->findBy($postId);

        //! ============================================


        //? add the translation to the article ==========

        $article->setTitle($translatedTitle);
        $translatedContent && $article->setContent($translatedContent);
        $article->setLocale($locale);
        
        //! ============================================
        
        $this->entityManager->persist($article);

    }
    



    /**
     * Recuperer une traduction d'un article dans une langue donnée
     * @param string $class The entity class name
     * @param int $id The object id
     * @param string $locale The locale to reload
     * @return void
     */
    public function reloadTranslations(string $class , int $id, string $locale): void
    {
        $object = $this->entityManager->getRepository($class)->find($id);
        $object->setLocale($locale);
        $this->entityManager->refresh($object);
    }



    /**
     * Recuperer toutes les traductions d'un article donné
     * @param string $class The entity class name
     * @param int $id The object id
     * @return array The registered translations
     */
    public function getAllTranslations(string $class, int $id) : array
    {
        $object = $this->entityManager->getRepository($class)->find($id);
        $translationRepository = $this->entityManager->getRepository('Gedmo\Translatable\Entity\Translation');
        $translations = $translationRepository->findTranslations($object);
        
        return $translations;
    }
}