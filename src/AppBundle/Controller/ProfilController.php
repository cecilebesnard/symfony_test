<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 20/01/17
 * Time: 11:57
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProfilController extends Controller
{
    /**
     * @Route("/accesclient", name="profil.accesclient")
     */
    public function accesClientAction()
    {
        $user = $this->getUser();
        //die(dump($user));


        if($this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('admin');
        }

        return $this->render('Profil/profil.html.twig' , ['user' => $user]);

    }
}