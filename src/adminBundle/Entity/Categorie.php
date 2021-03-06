<?php

namespace adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="adminBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Votre titre doit contenir au moins {{ limit }} caracteres"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     *
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="Position", type="integer")
     * @Assert\NotBlank()
     *
     */
    private $position;

    /**
     * @ORM\Column(name="Active", type="boolean")
     * @Assert\NotBlank()
     */
    private $active;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories")
     *
     */
    private $products;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Categorie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Categorie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Categorie
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @Assert\Callback
     */
    public function Validate(ExecutionContextInterface $context, $payload)
    {
        if($this->getPosition() == 0 && $this->getTitle() !="Par Défaut")
        {
            $context->buildViolation('La position 0 est reservée à la categorie "par defaut"')
               // ->atPath('position')
                ->addViolation();
        }
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Categorie
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \adminBundle\Entity\Product $product
     *
     * @return Categorie
     */
    public function addProduct(\adminBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \adminBundle\Entity\Product $product
     */
    public function removeProduct(\adminBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
