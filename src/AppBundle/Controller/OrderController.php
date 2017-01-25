<?php
/**
 * Created by PhpStorm.
 * User: wamobi5
 * Date: 24/01/17
 * Time: 11:02
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        //dump($request); exit;
        /* avant service Cartservice -> $request->getSession() equivaut dans le service à $this->session
        if(!$request->getSession()->has('order'))
        {
            $request->getSession()->set('order', [

            ]);
        }*/

        $this->get('admin.service.cart')->createOrder('order');
    }

    /**
     * @Route("/add/{id}", name="add.product", requirements={"id" = "\d+"} )
     */
    /*methode avant service cartService
    public function addProductAction(Request $request, $id)
    {
        //création du panier en session
        $this->createOrder($request);

        //pour ajouter un produit ds le panier
        // $panier = copie du panier (attention ne pas oublier de l'ajouter à la session
        $panier = $request->getSession()->get('order');
        $qte = $request->get('qte');

        // $panier[$id] = $qte;
        //die(dump($panier));


        // rechercher si l'id est existant (in_array)
        if(array_key_exists($id, $panier))
        {
            $panier[$id] += $qte;

            //die(dump($panier));
        }
        // si existant, recherche de sa position (array_search) dans le tableau puis incrémentation de la quantité
        else
        {
            $panier[$id]= $qte;
        }

        // ajout de la copie du panier à la session
        $request->getSession()->set('order', $panier);

        // die(dump($request->getSession()->get('order')));

        return $this->redirectToRoute('homepage');

    }*/
    public function addProductAction($id)
    {
        $this->get('admin.service.cart')->addproduct($id);

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/showCart", name="showCart")
     */
    /*methode avant le service cartService
    public function showCartAction(Request $request)
    {
        $panier = $request->getSession()->get('order');
        //(die(dump($panier)));

        $em= $this->getDoctrine()->getManager();

        $total = 0;
        $product = [];
        foreach ($panier as $key => $val)
        {
            $product[$key] = $em->getRepository("adminBundle:Product")->find($key);
            $product[$key]->qte = $val;
            $total += ($product[$key]->qte) * ($product[$key]->getPrice());
        }

        return $this->render('Public/Main/cart.html.twig', [
            'products' => $product,
            'total' => $total,
        ]);
    }
    */
    public function showCartAction()
    {
        $showCart = $this->get('admin.service.cart')->showCart();

        return $this->render('Public/Main/cart.html.twig', [
            'products' => $showCart['product'],
            'total' => $showCart['total'],
        ]);
    }


    /**
     * @Route("/update/{id}", name="update.product" , requirements={"id" = "\d+"})
     */
    /*avant service
    public function updateOrderAction($id , Request $request)
    {

        $panier = $request->getSession()->get('order');

        //$service = $this->get('admin.cart.session');


        //die(dump($qte));

        // rechercher si l'id est existant (in_array)
        if(array_key_exists($id, $panier))
        {
            $qte = $request->get('qte');
            //die(dump($qte));
            $panier[$id] = $qte;

            //die(dump($panier));
        }

        // ajout de la copie du panier à la session
        $request->getSession()->set('order', $panier);


        return $this->redirectToRoute('showCart');
    }*/
    public function updateOrderAction($id)
    {
        $this->get('admin.service.cart')-> updateOrder($id);
        return $this->redirectToRoute('showCart');
    }

    /**
     * @Route("/remove/{id}", name="remove.product", requirements={"id" = "\d+"} )
     */
    /*methode avant service
    public function removeProductAction($id, Request $request)
    {
        $panier = $request->getSession()->get('order');
        unset($panier[$id]);
        $request->getSession()->set('order', $panier);

        return $this->redirectToRoute('showCart');
    }*/
    public function removeProductAction($id)
    {
        $this->get('admin.service.cart')-> removeProduct($id);
        return $this->redirectToRoute('showCart');
    }
}

