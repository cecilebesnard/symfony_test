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
use adminBundle\Entity\Product;
use adminBundle\Form\ProductType;

class ProductController extends Controller
{
    /**
     * @Route("/product" , name="public_product")
     */
    public function productAction()
    {
        /*$em = $this->getDoctrine()->getManager();
        $products= $em->getRepository("adminBundle:Product")
            ->findAll();*/

        return $this->render('Public/Product/public.product.html.twig');
    }



}