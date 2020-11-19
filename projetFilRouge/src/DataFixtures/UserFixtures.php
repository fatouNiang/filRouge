<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Entity\CommunityManager;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    //public const USER_REFERENCE = 'user';

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){

        $this->encoder=$encoder;
    }


    public function load(ObjectManager $manager)
    {

        $faker= Factory::create("fr_FR");

        for ($i=0; $i < 4; $i++) { 
          
            if ($i==0) {
                $user= new Admin();
            }
            $nbrUSer=3;
            if($i==1){
                $nbrUSer=20;
            }
            if($i==1){
                $user= new Apprenant();  
                for ($a=0; $a < $nbrUSer; $a++) { 
                   
                    $user->setGenre("homme")
                        ->setAdresse('parcelle')
                        ->setStatut("visible");
                }
                            
            }
            if($i==2){
                $user= new CommunityManager();
                //echo 'CommunityManager';
            }
            if($i==3){
                $user= new Formateur();
            }
           // $photo = fopen($faker->imageUrl($width = 640, $height = 480),"rb");

            $user->setUsername("user".$i)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                //->setPhoto($photo)
                ->setPhoto("sdfghj")
                ->setPassword($this->encoder->encodePassword($user, 'pass_1234'));
            $user->setProfil($this->getReference(ProfilFixtures::PROFIL_REFERENCE.$i));

        
        $manager->persist($user);

        }

        $manager->flush();
        //$this->addReference(self::USER_REFERENCE, $profil);
    }
}
