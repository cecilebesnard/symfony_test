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


class MainController extends Controller
{

    /**
     * @Route("/" , name="homepage")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $products= $em->getRepository("adminBundle:Product")
            ->moreExpensive(6);

        $em = $this->getDoctrine()->getManager();
        $productsImage= $em->getRepository("adminBundle:Product")
            ->maxQuantity(3);

        $em2 = $this->getDoctrine()->getManager();
        $categories= $em2->getRepository("adminBundle:Categorie")
            ->findAll();

        return $this->render('Public/Main/index.html.twig' , [ 'products' => $products , 'productsImage' => $productsImage]);
    }

}