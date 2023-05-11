<?php

namespace App\DataFixtures;

use App\Repository\PostRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager, PostRepository $PostRepo): void
    {


        // for ($i = 0; $i < 20; i < 20)
        // $post = new PostRepo();
        // $manager->persist($product);

        $manager->flush();
    }
}
