<?php
namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Admin;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\ProfileFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AdminFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder )
    {
        $this->encoder = $encoder;
    
    }



    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR') ;

        $user = new Admin() ;
        $user ->setEmail ($faker->email);
        $password = $this->encoder->encodePassword($user, 'pass_1234') ;
        $user ->setPrenom($faker->name);
        $user ->setNom($faker->lastName);
        $user ->setUsername($faker->userName);
        $user ->setImage("");
        // $user ->setAddress($faker->address);
        //  $user->setArchivage(false) ;
        // this reference returns the User object created in UserFixtures
        $password = $this->encoder->encodePassword($user, 'pass_1234') ;
        $user->setPassword($password) ;
        //  $this->addReference(self::,$user);
        // $user->addReference($this->getReference(ProfileFixtures::ADMIN_REFERENCE));
        $user->setProfile($this->getReference(ProfileFixtures::ADMIN_REFERENCE)) ;

        $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProfileFixtures::class,
        );
    }
   
  
}

