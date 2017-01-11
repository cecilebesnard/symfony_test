<?php

namespace adminBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use adminBundle\Entity\Brand;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadBrandData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

       for ($i = 0; $i<5 ; $i++){
            $brand = new Brand();
            $brand->setTitle('une nouvelle marque '.$i);


            $manager->persist($brand);
            $manager->flush();

        // création d'une variable afin de pouvoir relier un produit à une id brand existante
            $this->addReference('nouvelle-marque'.$i, $brand);
        }
    }

    public function getOrder()
    {
        // Permet de choisir l'ordre d'execution des fixtures
        return 2;
    }
}

