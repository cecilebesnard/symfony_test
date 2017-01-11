<?php

namespace adminBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use adminBundle\Entity\Categorie;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCategorieData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i<10 ; $i++){
            $categorie = new Categorie();
            $categorie->setTitle('une nouvelle categorie ');
            $categorie->setDescription('Lorem Ipsum');
            $categorie->setPosition($i);
            $categorie->setActive(rand(0, 1));

            $manager->persist($categorie);
            $manager->flush();
        }
    }

    public function getOrder()
    {
        // Permet de choisir l'ordre d'execution des fixtures
        return 1;
    }
}

