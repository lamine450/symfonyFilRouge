<?php
namespace App\DataFixtures;


use App\DataFixtures\ProfileFixtures;
use App\Entity\Apprenat;
use App\Entity\Groupe;
use Faker\Factory;
use App\Entity\Admin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class ApprenatFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder )
    {
        $this->encoder = $encoder;

    }



    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR') ;
        for ($i=0; $i < 3 ; $i++) {
            $groupe1 = new Groupe();
            $groupe1->setNom('Groupe' . ($i + 1))
                ->setDateCreation(new \DateTime())
                ->setStatut('Statut' . ($i + 1))
                ->setType('Type' . ($i + 1));
            for ($j = 0; $j < 4; $j++) {
                $user = new Apprenat();
                $user->setEmail($faker->email);
                $password = $this->encoder->encodePassword($user, 'pass_1234');
                $user->setPrenom($faker->firstName());
                $user->setNom($faker->lastName);
                $user->setUsername($faker->userName);
                $user->setImage("");
                // $user ->setAddress($faker->address);
                //  $user->setArchivage(false) ;
                // this reference returns the User object created in UserFixtures
                $password = $this->encoder->encodePassword($user, 'pass_1234');
                $user->setPassword($password);
                //  $this->addReference(self::,$user);
                // $user->addReference($this->getReference(ProfileFixtures::APPRENAT_REFERENCE));
                $user->setProfile($this->getReference(ProfileFixtures::APPRENAT_REFERENCE));

                $manager->persist($user);

                $groupe1->addApprenat($user);
                $manager->persist($groupe1);

                $manager->flush();
            }
        }
    }

    public function getDependencies()
    {
        return array(
            ProfileFixtures::class,
        );
    }


}

