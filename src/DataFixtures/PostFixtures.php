<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\Format;
use DateTimeImmutable;
use App\Entity\Categorie;
use App\Entity\Calendrier;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\Length;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\Generator instance
        $faker = Factory::create();

        for ($i=0; $i < 10; $i++) {  
            $calendrier = new Calendrier;
            $calendrier->setBeginAt(DateTimeImmutable::createFromMutable($faker->dateTime()));
            $calendrier->setEndAt(DateTimeImmutable::createFromMutable($faker->dateTime()));
            $calendrier->setTitle($faker->word(3,true));
            $manager->persist($calendrier);
        }

        $allCategorie = ['développement', 'design', 'marketing', 'business', 'photographie', 'lifestyle', 'informatique', 'sport', 'voyage', 'musique'];
        for ($i=0; $i < count($allCategorie)-1; $i++) {  
            $categorie = new Categorie;
            $categorie->setNom($allCategorie[$i]);

            $manager->persist($categorie);
        }

        
        for ($i=0; $i < 3; $i++) {       
            
            $format = new Format;
            $format->setNom($faker->words(3, true));
            
            $manager->persist($format);
        }
        $manager->flush();


        for ($i=0; $i < 20; $i++) {
            $post = new Post;
            $post->setPricing($faker->numberBetween(0,1));
            $post->setShare($faker->numberBetween(0,1));
            $post->setTitre($faker->words(3,true));
            $post->setCorps($faker->paragraph(rand(5,8),true));
            $post->setDescription($faker->sentence(12));
            $post->setKeywords($faker->words(3,true));
            $post->setPublishAt(DateTimeImmutable::createFromMutable($faker->dateTime())); 
           
            
            $post->setFormat($manager->getRepository(Format::class)->findAll()[rand(0,count($manager->getRepository(Format::class)->findAll() ) - 1 )]);
            $post->addCategorie($manager->getRepository(Categorie::class)->findAll()[rand(0,count($manager->getRepository(Categorie::class)->findAll() ) - 1 )]);
            $post->addCategorie($manager->getRepository(Categorie::class)->findAll()[rand(0,count($manager->getRepository(Categorie::class)->findAll() ) - 1 )]);
            $post->addCategorie($manager->getRepository(Categorie::class)->findAll()[rand(0,count($manager->getRepository(Categorie::class)->findAll() ) - 1 )]);

            $post->setTheme($faker->words(3,true));
            $post->setSlug(
                // slug constituer du theme+titre+date de publication
                str_replace(' ','-',$post->getTheme().'--'.$post->getTitre().'-'.$post->getPublishAt()->format('Ymd'))
                
            );

            $manager->persist($post);
        }
        
        $manager->flush();
        

    }
}
