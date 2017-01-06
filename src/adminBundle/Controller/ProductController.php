<?php

namespace adminBundle\Controller;

use adminBundle\Entity\Product;
use adminBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/product" , name="product")
     */
    public function productAction()
    {
        /* avec la variable - avant la BDD
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
        ];*/

        $em = $this->getDoctrine()->getManager();
        $products= $em->getRepository("adminBundle:Product")
                        ->findAll();



        return $this->render('Product/product.html.twig' ,[ 'products' => $products ]);
    }

    /**
     * @Route("/product/{id}", name="show_product" , requirements={"id" = "\d+"})
     */
    public function showAction($id)
    {

        /*$products = [
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



        $product = [];

        foreach ($products as $p)
        {
            if ($p["id"] == $id)
            {


                $product = $p;
                break;
            }
        }*/

        $em = $this->getDoctrine()->getManager();
        $product= $em->getRepository("adminBundle:Product")
            ->find($id);

        if (empty($product)) {
            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        // TROUVER LE MOYEN D'ENVOYER UNIQUEMENT LE PRODUIT AYANT LE BON ID ($id doit correspondre à un id existant dans $products)
        return $this->render('Product/show.html.twig' , [ 'product' => $product ]);

    }

    /**
     * @Route("/product/creer", name="product_create")
     */
    public function createAction(Request $request)
    {
        $product = new Product();

        $formProduct = $this->createForm(ProductType::class , $product);
        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid())
        {
           // die(dump($product));

            //pour sauvegarder en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();


            $this->addFlash('success' , 'Votre produit a bien été ajouté');

            return $this->redirectToRoute('product/creer');
        }

        return $this->render('Product/create.html.twig', [
            'formProduct' => $formProduct->createView()
        ]);
    }

}
