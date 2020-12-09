<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfileFixtures extends Fixture
{
    public const ADMIN_REFERENCE = 'ADMIN';
    public const APPRENAT_REFERENCE = 'APPRENAT';
    public const FORMATEUR_REFERENCE = 'FORMATEUR';
    public const Cm_REFERENCE = 'Cm';

    public function load(ObjectManager $manager)
    {
        $profils = ["ADMIN","FORMATEUR","APPRENAT","CM"] ;

        for ($c=0; $c < count($profils) ; $c++)
        {
            $profil = new Profile() ;
            $profil->setLibelle($profils[$c]) ;
            if ($profils[$c] === "ADMIN")
            {

                $this->addReference(self::ADMIN_REFERENCE, $profil);
            }

             elseif ($profils[$c] == "APPRENAT")
                {
                     $this->addReference(self::APPRENAT_REFERENCE, $profil);
                }

                 elseif ($profils[$c] == "CM")
                 {
                    $this->addReference(self::Cm_REFERENCE, $profil);
                 }

             elseif ($profils[$c] == "FORMATEUR")
             {
               $this->addReference(self::FORMATEUR_REFERENCE, $profil);
             }


            $manager->persist($profil);

        }
        $manager->flush();
    }
}
