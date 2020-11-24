<?php

namespace App\DataFixtures;

use App\Entity\ProfilSortie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilSortieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $TabprofilSorti=["front-end", "back_end", "cms", "java", "php"];

        for ($i=0; $i <5 ; $i++) { 
           $pSorti= new ProfilSortie();
           $pSorti->setLibelle($TabprofilSorti[$i])
                ->setArchivage(false);
          $manager->persist($pSorti);
        }
        // $product = new Product();
        

        $manager->flush();
    }
}
