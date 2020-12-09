<?php

namespace App\DataFixtures;

use App\Entity\Competence;
use App\Entity\GroupeCompetence;
use App\Entity\Niveau;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupeCompetenceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tabDev=['html','php','java','dataArtisant'];
        $tabLibelle=['Developpement web','finance'];
        $tabDescritif=['Descritif en Developpement web','Descritif en finance'];

                            for ($j=0 ; $j<2 ; $j++)
                            {
                                $grpcompetence1=new GroupeCompetence();
                                $grpcompetence1->setLibelle($tabLibelle[$j])
                                    ->setDescritif($tabDescritif[$j]);
                                $manager->persist($grpcompetence1);

                            for ($c=0 ; $c< 4; $c++)
                            {
                                $competence = new Competence();
                                $competence->setLibelle($tabDev[$c]);
                                $competence->setDescritif($tabDev[$c]);

                            for($t=0; $t<3; $t++)
                            {
                                $niveau= new Niveau();
                                $niveau->setLibelle("Niveau ".($t+1))
                                    ->setCritéreEvaluation("CritereEvaluation ".($t+1))
                                    ->setGroupeAction("Groupe Action ".($t+1));
                                $manager->persist($niveau);
                                $competence->addNiveau($niveau);
                            }
            }
                $competence->addGroupeCompetence($grpcompetence1);
                $manager->persist($competence);


           }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
