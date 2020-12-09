<?php

namespace App\DataFixtures;

use App\Entity\GroupeTag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupeTagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++)
        {
            $groupeTag=new GroupeTag();
            $groupeTag->setLibelle("libelle" . ($i + 1));
            $manager->persist($groupeTag);
        }
        // $product = new Product();


        $manager->flush();
    }
}