<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 13/01/17
 * Time: 14:30
 */

namespace adminBundle\Twig;


use Doctrine\Bundle\DoctrineBundle\Registry;

class AppExtension extends \Twig_Extension
{
    private $doctrine;
    private $twig;

    public function __construct(Registry $doctrine , \Twig_Environment $twig)
    {
        $this->doctrine = $doctrine;
        $this->twig = $twig;
    }

    public function getFunctions()
    {
        //retourne une liste de nouvelle fonction ss forme de []
        //creer autant de new twig_single function que de nvelle fonction
        return [
          new \Twig_SimpleFunction('ma_fonction' , [$this, 'maFonction'])
        ];
    }

    public function maFonction()
    {
        $categories = $this->doctrine->getRepository('adminBundle:Categorie')->findAll();
        //die(dump($results));
        return $this->twig->render('Categorie/renderCategories.html.twig', ['categories' => $categories]);
    }
}