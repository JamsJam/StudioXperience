<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        require_once 'vendor/autoload.php';

        // use the factory to create a Faker\Generator instance
        $faker = Factory::create();
        $post = new Post();
        // $post->setPublishAt($faker->dateTime());


        $manager->flush();
    }
}
