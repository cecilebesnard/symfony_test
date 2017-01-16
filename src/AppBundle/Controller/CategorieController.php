<?php

namespace AppBundle\Controller;

use adminBundle\Entity\Categorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class CategorieController extends Controller
{


    /**
     * @Route("/publicCategorie/{id}", name="show_publicCategorie" , requirements={"id" = "\d+"})
     * @ParamConverter("categorie", class="adminBundle:Categorie")
     */
    public function showAction(Categorie $categorie, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $page = $request->query->get('page', 1);
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * 4;

        $products = $em->getRepository('adminBundle:Product')->myFindProductionSelonCategorie($categorie->getId(), $offset);
$totalProducts = $categorie->getProducts();
        //die(dump($products));


// TROUVER LE MOYEN D'ENVOYER UNIQUEMENT LE PRODUIT AYANT LE BON ID ($id doit correspondre à un id existant dans $products)
        return $this->render('Public/Categorie/public.categorie.html.twig', ['categorie' => $categorie , 'products' => $products , 'totalProducts' => $totalProducts , 'page' => $page]);

    }

}
