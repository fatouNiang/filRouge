<?php

namespace App\DataFixtures;

//use Faker\Factory;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
     * 
     * @var UserPasswordEncoderInterface 
     */

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){

        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();

        $faker= Factory::create("fr_FR");

        for ($i=0; $i < 5; $i++) { 
           $user= new User();
           //password = ;
           $user->setUsername("user".$i)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setPassword($this->encoder->encodePassword($user, 'pass_1234'));
            $manager->persist($user);

        }

        $manager->flush();
    }
}
