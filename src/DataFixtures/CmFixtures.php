<?php
namespace App\DataFixtures;


use App\DataFixtures\ProfileFixtures;
use Faker\Factory;
use App\Entity\CM;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class CmFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder )
    {
        $this->encoder = $encoder;

    }



    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR') ;

        $user = new CM() ;
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
        $user->setProfile($this->getReference(ProfileFixtures::Cm_REFERENCE)) ;

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

