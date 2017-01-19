<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



class TranslationController extends Controller
{

/**
* @Route("/translation", name="translation.index")
*/
public function indexAction(Request $request)
{

    $locale = $request->getLocale();
    $doctrine = $this->getDoctrine();
    $result = $doctrine->getRepository('adminBundle:Product')
                       ->findProductByLocale(263, $locale);

    die(dump($result));

return $this->render('Public/Translation/public.index.html.twig' , ['productLocale' => $result]);
}
}