<?php
namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Profil;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Entity\CommunityManager;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{

    private $encode;
    protected $profilRepositiry;
    public function __construct(UserPasswordEncoderInterface $encode)
    {
        $this->encode=$encode;
    }

    
    public function load(ObjectManager $manager)

    {
        $fake = Factory::create('fr-FR');
            for($i=0;$i<=3;$i++){

                $nbrUser=5;
                $userProfil=$this->getReference(ProfilFixtures::getReferenceKey($i %4));


                if($userProfil->getLibelle() ==="Apprenant"){
                    $nbrUser=10;
                }

                for ($b=1;$b<=$nbrUser;$b++){

                    $user=new User();

                    if($userProfil->getLibelle()==="Apprenant"){

                        $user=new Apprenant();
                        $user->setGenre($fake->randomElement(['homme','femme']))
                            //->setTelephone($fake->phoneNumber())
                            ->setStatut("actif")
                            ->setAdresse($fake->address());
                    }
                    if($userProfil->getLibelle()==="Formateur"){
                        $user=new Formateur();
                    }
                    if($userProfil->getLibelle()==="Community Manager"){
                        $user=new CommunityManager();
                    }

                if($userProfil->getLibelle()==="Administrateur"){

                    $user=new Admin();

                }
                    $user->setProfil($userProfil)
                        ->setUsername( strtolower ($fake->userName))
                        ->setFirstName($fake->firstName)
                        ->setLastName($fake->lastName)
                        ->setEmail($fake->email)
                        ->setArchivage(false);
                    //$photo = fopen($fake->imageUrl($width = 640, $height = 480),"rb");
                    $user->setPhoto("vous");
                    $password = $this->encode->encodePassword ($user, 'pass_1234' );
                    $user->setPassword($password);
                    
                    $manager->persist($user);
                }
            }
            $manager->flush();

    }
    public function getDependencies()
    {
        return array(
            ProfilFixtures::class,
        );
    }

}