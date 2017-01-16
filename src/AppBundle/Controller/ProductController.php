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


class ProductController extends Controller
{

    /**
     * @Route("/publicProduct/{id}", name="show_publicProduct" , requirements={"id" = "\d+"})
     */
    public function showAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository("adminBundle:Product")
            ->find($id);

        if (empty($product)) {
            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        return $this->render('Public/Product/public.product.html.twig' , [ 'product' => $product]);
    }
}