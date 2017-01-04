<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $firstName = 'cecile';
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR, 'firstName' => $firstName
        ]);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $firstName = 'cecile';
        $lastName = 'besnard';

        // replace this example code with whatever you need
        return $this->render('contact.html.twig', ['firstName' => $firstName , 'lastName' => $lastName
        ]);
    }

    /**
     * @Route("/products", name="products")
     */
    public function productsAction(Request $request)
    {
        $firstName = 'cecile';
        $lastName = 'besnard';
        $products = [
            [
                "id" => 1,
                "title" => "Mon premier produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 10
            ],
            [
                "id" => 2,
                "title" => "Mon deuxième produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 20
            ],
            [
                "id" => 3,
                "title" => "Mon troisième produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 30
            ],
            [
                "id" => 4,
                "title" => "",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 410
            ],
            ];



        // replace this example code with whatever you need
        return $this->render('products.html.twig', [ 'products' => $products , 'firstName' => $firstName , 'lastName' => $lastName
        ]);
    }

    /**
     * @Route("/bloc_fille", name="fille")
     */
    public function filleAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('bloc-fille.html.twig', [
        ]);
    }


    /**
     * @Route("/bloc_mere", name="mere")
     */
    public function mereAction(Request $request)
    {


        // replace this example code with whatever you need
        return $this->render('bloc-mere.html.twig', [
        ]);
    }

    /**
     * @Route("/bloc_frere", name="frere")
     */
    public function frereAction(Request $request)
    {


        // replace this example code with whatever you need
        return $this->render('bloc-frere.html.twig', [
        ]);
    }
}
