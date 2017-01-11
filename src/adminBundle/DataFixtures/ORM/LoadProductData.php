<?php

namespace adminBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use adminBundle\Entity\Product;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

       for ($i = 0; $i<5 ; $i++)
       {
        for ($j = 0; $j<3 ; $j++)
        {

        $product = new Product();
        $product->setTitle('un nouveau titre '.$j);
        $product->setDescription('Lorem Ipsum'.$j);
        $product->setPrice(rand(1,1000));
        $product->setQuantity(rand(2, 15));

        $product->setMarque($this->getReference('nouvelle-marque'.$i));


        $manager->persist($product);
        $manager->flush();
        }
       }
    }

    public function getOrder()
    {
        // Permet de choisir l'ordre d'execution des fixtures
        return 3;
    }
}

