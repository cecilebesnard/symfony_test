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


class ProductController extends Controller
{

    /**
     * @Route("/publicProduct/{id}", name="show_publicProduct" , requirements={"id" = "\d+"})
     */
    public function showAction(Request $request ,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository("adminBundle:Product")
            ->find($id);

        $em1 = $this->getDoctrine()->getManager();
        $comments = $em1->getRepository("adminBundle:Comment")
            ->findBy(['id_product' => $product->getId()]);

        $locale = $request->getLocale();
        $doctrine = $this->getDoctrine();
        $productLocale = $doctrine->getRepository('adminBundle:Product')
            ->findProductByLocale($id, $locale);

        if (empty($product)) {
            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        return $this->render('Public/Product/public.product.html.twig' , [ 'product' => $product , 'comments' => $comments , 'productLocale' => $productLocale]);
    }
}