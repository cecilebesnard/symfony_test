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

}