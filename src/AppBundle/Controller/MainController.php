<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 13/01/17
 * Time: 16:25
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MainController extends Controller
{



    /**
     * @Route("/" , name="homepage")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $products= $em->getRepository("adminBundle:Product")
            ->moreExpensive(6);

        //$em = $this->getDoctrine()->getManager();
        $productsImage= $em->getRepository("adminBundle:Product")
            ->maxQuantity(3);

        $locale = $request->getLocale();
        $doctrine = $this->getDoctrine();
        $productLocale = $doctrine->getRepository('adminBundle:Product')
            ->findProductsByLocale($locale);

        return $this->render('Public/Main/index.html.twig' , [ 'products' => $products , 'productsImage' => $productsImage , 'productLocale' => $productLocale]);
    }


    /**
     * @Route("/disclaimer-cookies" , name="disclaimer.cookies")
     */
    public function disclaimerCookiesAction(Request $request)
    {
        //get('disclaimer') correspond à la variable dans data: envoyée en ajax
        $disclaimer = $request->get('disclaimer');
        //die(dump($disclaimer));

        //stocker la variable dans une session
        $session = $request->getSession();
        $session->set('disclaimer' , $disclaimer);

        //dump visible dans onglet reseau\selectionner la requete\aperçu
        //die(dump($session->get('disclaimer')));

        return new JsonResponse
        ([
            'success' => 'ok'
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $saisie = $request->get('search');
        //die(dump($saisie));
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('adminBundle:Product')->searchProduct($saisie);

        return $this->render('Public/Main/search.html.twig' , [ 'products' => $products]);
    }

    /**
     * @Route("/autocomplete", name="autocomplete")
     */
    public function autocompleteAction(Request $request)
    {
        $saisie = $request->get('search');
        //die(dump($saisie));
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('adminBundle:Product')->searchProduct($saisie);

        return new JsonResponse
        ([
            'products' => $products
        ]);
    }




}