<?php

namespace adminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/" ,name="admin")
     */
    public function indexAction()
    {
        return $this->render('Default/index.html.twig');
    }

    /**
     * @Route("/contact" ,name="contact")
     */
    public function contactAction(Request $request)
    {


        $formContact = $this->createFormBuilder()
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('content', TextareaType::class)
            ->getForm();

        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            //Dump de $_POST
            //dump($request->request->all());

            //Dump de $_GET
            //dump($request->query->all());

            //recuperer les informations du formulaire
            //dump($formContact->getData());

            // Récupérer une valeur précisément du formulaire
            //dump($formContact->get('firstname')->getData());

            // La technique a utilisée est d'utiliser une varabiel ex: $data et de manipuler cette variable
            $data = $formContact->getData();
            //dump($data);

            // Envoi du mail
            $message = \Swift_Message::newInstance()
                ->setSubject('Formulaire de contact')
                ->setFrom($data['email'])
                ->setTo('mailtest@test.fr')
                ->setBody(
                    $this->renderView('emails/formulaire-contact.html.twig', ["data" => $data]),
                    'text/html'
                )
                ->addPart(
                    $this->renderView('emails/formulaire-contact.txt.twig', ["data" => $data]),
                    'text/plain'
                );
            $this->get('mailer')->send($message);

            // Affichage du message de success
            $this->addFlash('success', 'Votre email a bien été envoyé');
            // Redirection
            return $this->redirectToRoute('contact');


        }


        return $this->render('Default/contact.html.twig', ["formContact" => $formContact->createView()]);
    }


    /**
     * @Route("/feedback" ,name="feedback")
     */
    public function feedbackAction(Request $request)
    {
        $formFeedback = $this->createFormBuilder()
            ->add('page', UrlType::class)
            ->add('bugstatut', ChoiceType::class ,array(
                'choices' => array("Technique" => "Technique" , "Design" => "Design" ,  "Marketing" => "Marketing"  , "Autre" => "Autre")))
            ->add('firstname' , TextType::class)
            ->add('lastname' , TextType::class)
            ->add('email', EmailType::class)
            ->add('datebug' , DateType::class , [
                    "data" => new \DateTime(),
                    'widget' => 'choice' ,
                    'format' => 'd/MMM/y' ,
                    'years' => range(date('Y')-10, date('Y')+10)

            ])
            ->add('content', TextareaType::class)
            ->add('testdate' , DateType::class, [
                'widget' => 'single_text'])
            ->getForm();

        $formFeedback->handleRequest($request);

        if ($formFeedback->isSubmitted() && $formFeedback->isValid())
        {
            $datafeedback = $formFeedback->getData();

            // Envoi du mail


            $message = \Swift_Message::newInstance()
                ->setSubject('Feedback')
                ->setFrom($datafeedback['email'])
                ->setTo($this->getParameter('mailer_admin'))
                ->setBody(
                    $this->renderView('emails/feedback.html.twig', ["datafeedback" => $datafeedback]),
                    'text/html'
                )
                ->addPart(
                    $this->renderView('emails/feedback.txt.twig', ["datafeedback" => $datafeedback]),
                    'text/plain'
                );
            $this->get('mailer')->send($message);


            // Affichage du message de success

            $name = $datafeedback['firstname'];



            $this->addFlash('success', 'Merci '.$name.' Votre message a bien été transmis');
            // Redirection
            return $this->redirectToRoute('feedback');
        }

        return $this->render('Default/feedback.html.twig', ["formFeedback" => $formFeedback->createView()]);
    }
}