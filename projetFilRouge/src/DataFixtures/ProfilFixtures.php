<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilFixtures extends Fixture
{
    public const PROFIL_REFERENCE = 'profil';

    public function load(ObjectManager $manager)
    {
        
        $profils= ["ADMIN", "APPRENANT", "CM", "FORMATEUR"];

        for ($i=0; $i < 4; $i++) { 
           $profil= new Profil();
           $profil->setLibelle($profils[$i])
                ->setArchivage(false);

        $manager->persist($profil);
        $this->addReference(self::PROFIL_REFERENCE.$i, $profil);
        }
        $manager->flush();
        
    }
}

