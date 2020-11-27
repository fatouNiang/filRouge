<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupeTag;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeTagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tabGTag=["gtag1","gtag2","gtag3","gtag4","gtag5"];
        $fake = Factory::create('fr-FR');

        for ($i=0; $i < 5; $i++) { 
            $gtag= new GroupeTag();
            $gtag->setLibelle($tabGTag[$i])
                ->setDescription("Lorem , sit amet officiis i ritaque id eum quo eaque qui veritatis.");
            $manager->persist($gtag);

        }
        $manager->flush();
    }
}
