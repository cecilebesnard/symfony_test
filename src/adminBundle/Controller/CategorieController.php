<?php

namespace adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategorieController extends Controller
{
    /**
     * @Route("/categorie" , name="categorie")
     */
    public function categoriesAction()
    {
        $categories = [
            1 => [
                "id" => 1,
                "title" => "Homme",
                "description" => "lorem ipsum \n suite du contenu",
                "date_created" => new \DateTime('now'),
                "active" => true
            ],
            2 => [
                "id" => 2,
                "title" => "Femme",
                "description" => "<strong>lorem</strong> ipsum",
                "date_created" => new \DateTime('-10 Days'),
                "active" => true
            ],
            3 => [
                "id" => 3,
                "title" => "Enfant",
                "description" => "lorem ipsum Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.",
                "date_created" => new \DateTime('-1 Days'),
                "active" => false
            ],
        ];

        return $this->render('Categorie/categorie.html.twig' ,[ 'categories' => $categories ]);
    }

    /**
     * @Route("/categorie/{id}", name="show_categorie" , requirements={"id" = "\d+"})
     */
    public function showAction($id)
    {

        $categories = [
            1 => [
                "id" => 1,
                "title" => "Homme",
                "description" => "lorem ipsum \n suite du contenu",
                "date_created" => new \DateTime('now'),
                "active" => true
            ],
            2 => [
                "id" => 2,
                "title" => "Femme",
                "description" => "<strong>lorem</strong> ipsum",
                "date_created" => new \DateTime('-10 Days'),
                "active" => true
            ],
            3 => [
                "id" => 3,
                "title" => "Enfant",
                "description" => "lorem ipsum ",
                "date_created" => new \DateTime('-1 Days'),
                "active" => false
            ],
        ];

        $categorie = [];



        foreach ($categories as $c)
        {
            if ($c["id"] == $id)
            {
                $categorie = $c;
                break;
            }
        }

        if (empty($categorie)) {
            throw $this->createNotFoundException("La categorie n'existe pas");
        }

        // TROUVER LE MOYEN D'ENVOYER UNIQUEMENT LE PRODUIT AYANT LE BON ID ($id doit correspondre à un id existant dans $products)
        return $this->render('Categorie/show.html.twig' , [ 'categorie' => $categorie ]);

    }

}