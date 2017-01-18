<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 16/01/17
 * Time: 16:39
 */

namespace adminBundle\Listener;


use adminBundle\Entity\Comment;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class CommentListener
{
    public function prePersist(Comment $entity, LifecycleEventArgs $args)
    {
        $setCreateAt = new \DateTime('now');
        $entity->setCreateAt($setCreateAt);

    }

}