<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 12/01/17
 * Time: 09:48
 */

namespace AppBundle\Listener;


use AppBundle\Entity\Orders;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class OrderListener
{
    public function prePersist(Orders $entity, LifecycleEventArgs $args)
    {
        $createdAt = new \DateTime('now');
        $entity->setCreatedDate($createdAt);
    }

}