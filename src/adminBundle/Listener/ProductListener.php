<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 12/01/17
 * Time: 09:48
 */

namespace adminBundle\Listener;


use adminBundle\Entity\Product;
use adminBundle\Service\UnlinkService;
use adminBundle\Service\UploadService;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;




class ProductListener
{
    private $uploadService;
    private $ancien_img;
    private $uploadDir;
    private $unlinkService;

    public function __construct(UploadService $uploadService, $uploadDir , UnlinkService $unlinkService )
    {
        $this->uploadService = $uploadService;
        $this->uploadDir = $uploadDir;
        $this->unlinkService = $unlinkService;
    }


    /*public function postPersist(Product $entity , LifecycleEventArgs $args)
    {
        die(dump($entity));
    }*/

    public function prePersist(Product $entity, LifecycleEventArgs $args)
    {
        $createdAt = new \DateTime('now');
        $entity->setCreatedAt($createdAt)
               ->setUpdateAt($createdAt);

        //recuperation de l'image
        $image = $entity->getImage();
       //die(dump($image));
        if(empty($image))
        {
            $filename = "nomfichier.png" ;
        }
        else
        {
            $filename = $this->uploadService->upload($image);
        }


        //non unique ds la BDD
        $entity->setImage($filename);
    }

    public function preUpdate(Product $entity , PreUpdateEventArgs $args)
    {
        $updateAt = new \DateTime('now');
        $entity->setUpdateAt($updateAt);

        //recuperation de l'image
        $image = $entity->getImage();
        //die(dump($image));
        if(empty($image))
        {
            $filename = $this->ancien_img ;
        }
        else
        {
            $filename = $this->uploadService->upload($image);
        }

        //non unique ds la BDD
        $entity->setImage($filename);
    }

    public function postUpdate(Product $entity , LifecycleEventArgs $args)
    {

        if($this->ancien_img != $entity->getImage() && $this->ancien_img != "nomfichier.png" )
        {

            $this->unlinkService->remove($this->ancien_img);

        }
    }

    public function postLoad(Product $entity ,LifecycleEventArgs $args)
    {
        $this->ancien_img = $entity->getImage();
        //die(dump($image));

    }

    public function postRemove(Product $entity ,LifecycleEventArgs $args)
    {
        if($entity->getImage() != "nomfichier.png")
        {
            $this->unlinkService->remove($entity->getImage());
        }
    }
}