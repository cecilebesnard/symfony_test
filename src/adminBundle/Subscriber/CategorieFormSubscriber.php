<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 20/01/17
 * Time: 09:37
 */

namespace adminBundle\Subscriber;




use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategorieFormSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'postSetData'
        ];
    }

    public function postSetData(FormEvent $event)
    {
        $entity = $event->getData();
        $form = $event->getForm();


        if($entity->getId() != null)
        {
            $form->remove('position');
            $form->add('description');
        }
        else
        {
            $form->add('description' , TextareaType::class,[
               'constraints' => [
                   new NotBlank([
                       'message' => 'la description est vide'
                   ])

               ]
            ]);
        }

        //die(dump($event));
    }
}