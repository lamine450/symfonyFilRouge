<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //instaciation des classes
        for($i=0;$i<2;$i++)
        {
            $tag=new Tag();
            $tag->setLibelle("libelle".($i+1))
                ->setDescription("description".($i+1));
            $manager->persist($tag);
        }
        // $product = new Product();

        $manager->flush();
    }
}
