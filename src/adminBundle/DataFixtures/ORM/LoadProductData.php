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

       for ($i = 0; $i<10 ; $i++)
       {


        $product = new Product();
        $product->setTitleFR('un nouveau titre '.$i);
        $product->setTitleEN('A new title '.$i);
        $product->setDescriptionFR('Lorem Ipsum'.$i);
        $product->setDescriptionEN('Lorem Ipsum'.$i);
        $product->setPrice(rand(1,1000));
        $product->setQuantity(rand(2, 15));

        $product->setMarque($this->getReference('nouvelle-marque'.$i));

           //creation d'une boucle afin d'avoir 3 cat dans chaque produit
           for ($j = 0; $j<5 ; $j++)
           {
        $product->addCategory($this->getReference('nouvelle-categorie' . $j));
           }

        $manager->persist($product);
        $manager->flush();

       }
    }

    public function getOrder()
    {
        // Permet de choisir l'ordre d'execution des fixtures
        return 3;
    }
}

