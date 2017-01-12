<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 12/01/17
 * Time: 09:48
 */

namespace adminBundle\Listener;


use adminBundle\Entity\Product;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;


class ProductListener
{

    /*public function postPersist(Product $entity , LifecycleEventArgs $args)
    {
        die(dump($entity));
    }*/

    public function prePersist(Product $entity, LifecycleEventArgs $args)
    {
        $createdAt = new \DateTime('now');
        $entity->setCreatedAt($createdAt)
               ->setUpdateAt($createdAt);
    }

    public function preUpdate(Product $entity , PreUpdateEventArgs $args)
    {
        $updateAt = new \DateTime('now');
        $entity->setUpdateAt($updateAt);

    }
}