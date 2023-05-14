<?php

namespace App\DataFixtures;

use App\Entity\Format;
use Faker\Factory;
use App\Entity\Post;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        require_once 'vendor/autoload.php';

        // use the factory to create a Faker\Generator instance
        $faker = Factory::create();
        $format = new Format;
        $format->setNom($faker->words(3, true));
        $post = new Post();
        $post->isPricing($faker->numberBetween(0,1));
        $post->setPublishAt(DateTimeImmutable::createFromMutable($faker->dateTime()));
        $post->isShare($faker->numberBetween(0,1));
        $post->setTitre($faker->text(8));
        $post->setCorps($faker->paragraph(rand(5,8),true));
        $post->setDescription($faker->sentence(12));
         
        $manager->flush();
    }
}
