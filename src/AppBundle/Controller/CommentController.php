<?php

namespace AppBundle\Controller;

use adminBundle\Entity\Comment;
use adminBundle\Entity\Product;
use adminBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



class CommentController extends Controller
{
    /**
     * @Route("/comment/{id}", name="comment" , requirements={"id" = "\d+"})
     */
    public function createAction(Request $request ,Product $id)
    {

        $comment = new Comment();
        //dump($comment);
        $comment->setIdProduct($id);

        //die(dump($comment));

        $formComment = $this->createForm(CommentType::class , $comment);

        $formComment ->handleRequest($request);

        if ($formComment ->isSubmitted() && $formComment ->isValid())
        {
            //die(dump($product));

            //pour sauvegarder en bdd
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();


            $this->addFlash('success' , 'Votre commentaire a bien été ajouté');

            return $this->redirectToRoute('homepage');
        }
       // die(dump($formComment));
        return $this->render('Public/Product/public.comment.html.twig', [
            'formComment' => $formComment->createView() , 'comment' => $comment , 'product' => $id
        ]);

    }

}