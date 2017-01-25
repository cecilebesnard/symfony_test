<?php


namespace adminBundle\Service;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

class CartService
{
    private $session;
    private $doctrine;
    private $requestStack;

    public function __construct(Session $session , Registry $doctrine , RequestStack $requestStack)
    {
        $this->session = $session;
        $this->doctrine = $doctrine;
        $this->requestStack = $requestStack->getCurrentRequest();
    }


    public function createOrder($nameSession)
    {
        //$this->session est une methode de Session et equivaut à la methode de request $request->getSession
        if(!$this->session->has($nameSession))
        {
            $this->session->set($nameSession, [

            ]);
        }

    }

    public function addProduct($id)
    {
        //création du panier en session
        $this->createOrder('order');

        //pour ajouter un produit ds le panier
        // $panier = copie du panier (attention ne pas oublier de l'ajouter à la session
        $panier = $this->session->get('order');
        $qte = $this->requestStack->get('qte');

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
        $this->session->set('order', $panier);

        // die(dump($request->getSession()->get('order')));
    }

    public function showCart()
    {
        $panier = $this->session->get('order');
        //(die(dump($panier)));

        $em= $this->doctrine->getManager();

        $total = 0;
        $product = [];

        if(!empty($panier)) {
            foreach ($panier as $key => $val) {
                $product[$key] = $em->getRepository("adminBundle:Product")->find($key);
                $product[$key]->qte = $val;
                $total += ($product[$key]->qte) * ($product[$key]->getPrice());
            }
        }
        return [
            'product' => $product,
            'total' => $total,
        ];
    }

    public function updateOrder($id)
    {

        $panier = $this->session->get('order');

        //$service = $this->get('admin.cart.session');


        //die(dump($qte));

        // rechercher si l'id est existant (in_array)
        if(array_key_exists($id, $panier))
        {
            $qte = $this->requestStack->get('qte');
            //die(dump($qte));
            $panier[$id] = $qte;

            //die(dump($panier));
        }

        // ajout de la copie du panier à la session
        $this->session->set('order', $panier);

    }

    public function removeProduct($id)
    {
        $panier = $this->session->get('order');
        unset($panier[$id]);
        $this->session->set('order', $panier);


    }
}