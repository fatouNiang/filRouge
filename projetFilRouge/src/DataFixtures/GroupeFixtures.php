<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        for ($i=0; $i <5 ; $i++) { 
            $GTag="ghhjjj";
        }
        // $manager->persist($product);

        $manager->flush();
    }
}
