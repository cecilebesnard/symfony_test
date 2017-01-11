<?php

namespace adminBundle\Controller;

use adminBundle\Entity\Categorie;
use adminBundle\Form\CategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    /**
     * @Route("/categorie" , name="categorie")
     */
    public function categoriesAction()
    {
        /*$categories = [
            1 => [
                "id" => 1,
                "title" => "Homme",
                "description" => "lorem ipsum \n suite du contenu",
                "date_created" => new \DateTime('now'),
                "active" => true
            ],
            2 => [
                "id" => 2,
                "title" => "Femme",
                "description" => "<strong>lorem</strong> ipsum",
                "date_created" => new \DateTime('-10 Days'),
                "active" => true
            ],
            3 => [
                "id" => 3,
                "title" => "Enfant",
                "description" => "lorem ipsum Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.",
                "date_created" => new \DateTime('-1 Days'),
                "active" => false
            ],
        ];*/

        $em = $this->getDoctrine()->getManager();
        $categories= $em->getRepository("adminBundle:Categorie")
            ->findAll();




        return $this->render('Categorie/categorie.html.twig' ,[ 'categories' => $categories ]);
    }

    /**
     * @Route("/categorie/{id}", name="show_categorie" , requirements={"id" = "\d+"})
     * @ParamConverter("categorie", class="adminBundle:Categorie")
     */
    public function showAction(Categorie $categorie)
    {

        /*$categories = [
            1 => [
                "id" => 1,
                "title" => "Homme",
                "description" => "lorem ipsum \n suite du contenu",
                "date_created" => new \DateTime('now'),
                "active" => true
            ],
            2 => [
                "id" => 2,
                "title" => "Femme",
                "description" => "<strong>lorem</strong> ipsum",
                "date_created" => new \DateTime('-10 Days'),
                "active" => true
            ],
            3 => [
                "id" => 3,
                "title" => "Enfant",
                "description" => "lorem ipsum ",
                "date_created" => new \DateTime('-1 Days'),
                "active" => false
            ],
        ];

        $categorie = [];



        foreach ($categories as $c)
        {
            if ($c["id"] == $id)
            {
                $categorie = $c;
                break;
            }
        }*/

        /*$em = $this->getDoctrine()->getManager();
        $categorie= $em->getRepository("adminBundle:Categorie")
            ->find($id);

        if (empty($categorie)) {
            throw $this->createNotFoundException("La categorie n'existe pas");
        }*/

        // TROUVER LE MOYEN D'ENVOYER UNIQUEMENT LE PRODUIT AYANT LE BON ID ($id doit correspondre à un id existant dans $products)
        return $this->render('Categorie/show.html.twig' , [ 'categorie' => $categorie ]);

    }

    /**
     * @Route("/categorie/creer", name="categorie_create")
     */
    public function createAction(Request $request)
    {
        $categorie = new Categorie();

        $formCategorie = $this->createForm(CategorieType::class , $categorie);
        $formCategorie->handleRequest($request);

        if ($formCategorie->isSubmitted() && $formCategorie->isValid())
        {
            // die(dump($categorie));

            //pour sauvegarder en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();


            $this->addFlash('success' , 'Votre categorie a bien été ajouté');

            return $this->redirectToRoute('categorie_create');
        }

        return $this->render('Categorie/create.html.twig', [
            'formCategorie' => $formCategorie->createView()
        ]);
    }

    /**
     * @Route("/categorie/modifier/{id}", name="categorie_modify" , requirements={"id" = "\d+"})
     */
    public function modifyAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie= $em->getRepository("adminBundle:Categorie")
            ->find($id);

        //verifcation si le produit est bien en BDD
        if(!$categorie)
        {
            throw $this->createNotFoundException('le categorie n\'existe pas');
        }
        $formCategorie = $this->createForm(CategorieType::class , $categorie);
        $formCategorie->handleRequest($request);

        if ($formCategorie->isSubmitted() && $formCategorie->isValid())
        {
            // die(dump($categorie));

            //pour sauvegarder en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();


            $this->addFlash('success2' , 'Votre Categorie a bien été modifié');

            return $this->redirectToRoute('show_categorie', ['id' => $id]);
        }

        return $this->render('Categorie/create.html.twig', [
            'formCategorie' => $formCategorie->createView()
        ]);
    }

    /**
     * @Route("/categorie/supprimer/{id}", name="categorie_remove" , requirements={"id" = "\d+"})
     */
    public function removeAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('adminBundle:Categorie')->find($id);

        // Vérification si la categorie est bien en BDD
        if (!$categorie) {

            throw $this->createNotFoundException("Le categorie n'existe pas");
        }

        $em->remove($categorie);
        $em->flush();

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(['message' => 'Votre categorie a bien été supprimée']);
        }

        $this->addFlash('success3' , 'Votre categorie a bien été supprimé');


        // Redirection sur la page qui liste tous les produits
        return $this->redirectToRoute('categorie');
    }

    public function renderCategorieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('adminBundle:Categorie')->findAll();
        //die(dump($categories));

        return $this->render('Categorie/renderCategories.html.twig', ['categories' => $categories]);
    }

}