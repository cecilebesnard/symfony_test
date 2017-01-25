<?php

namespace adminBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class KernelEventsSubscriber implements EventSubscriberInterface
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }


    public static function getSubscribedEvents()
    {
        return[
            // mettre en commentaire le request pour le desactiver
            //KernelEvents::REQUEST => 'kernelRequest',
            KernelEvents::REQUEST => 'blockCountry',
            KernelEvents::RESPONSE => 'addCookiesBlock'
        ];
    }


    public function addCookiesBlock(FilterResponseEvent $event)
    {
        $content = $event->getResponse()->getContent();
        $content = str_replace('<body>', '
        <body>
            <div class="cookies">Ce site utilise les cookies
            <a href="#" class="btn btn-success">J\'ai compris</a>
            </div>' , $content);

        $response = new Response($content);
        $event->setResponse($response);
    }

    public function blockCountry(GetResponseEvent $event)
    {
        //$ip = $event->getRequest()->getClientIp();
        $ip = '89.227.222.139';
        $ipService = file_get_contents("http://www.webservicex.net/geoipservice.asmx/GetGeoIP?IPAddress=$ip");
        //fonction simplexml_load_string converti de xlm en objet php
        $xml = simplexml_load_string($ipService);
        //die(dump($xml->CountryName));

        if($xml->CountryName != 'France')
        {
            //ici on renvoit vers la page maintenance pour le test mais prevoir une page adequate
            $view = $this->twig->render('Public/Maintenance/maintenance.html.twig');
            $response = new Response($view , 503);
            $event->setResponse($response);
        }



    }

    public function kernelRequest(GetResponseEvent $event)
    {
        //die(dump('kernel request'));
        $request = $event->getRequest();
        $content = $event->getResponse();

        $view = $this->twig->render('Public/Maintenance/maintenance.html.twig');
        $response = new Response($view , 503);
        $event->setResponse($response);
    }
}

