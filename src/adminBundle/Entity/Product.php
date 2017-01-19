<?php

namespace adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="adminBundle\Repository\ProductRepository")
 * @ORM\EntityListeners({"adminBundle\Listener\ProductListener"})
 */
class Product
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
     * @ORM\Column(name="titleFR", type="string", length=100)
     * @Assert\NotBlank(message="product.titleFR")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Votre titre doit contenir au moins {{ limit }} caracteres",
     *      maxMessage = "Votre titre doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $titleFR;

    /**
     * @var string
     *
     * @ORM\Column(name="titleEN", type="string", length=100)
     * @Assert\NotBlank(message="product.titleEN")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Votre titre doit contenir au moins {{ limit }} caracteres",
     *      maxMessage = "Votre titre doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $titleEN;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionFR", type="text")
     * @Assert\NotBlank()
     * *@Assert\Length(
     *      max = 300,
     *      maxMessage = "Votre titre doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $descriptionFR;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEN", type="text")
     * @Assert\NotBlank()
     * *@Assert\Length(
     *      max = 300,
     *      maxMessage = "Votre titre doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $descriptionEN;


    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(
     *     value = 0,
     *     message = "Le prix doit etre superieur {{ compared_value }}"
     * )
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="integer")
     * @Assert\NotBlank()
     */
    private $quantity;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Brand")
     *
     * @ORM\JoinColumn(name="id_brand", referencedColumnName="id", nullable=false)
     */
    private $marque;


    /**
     * @Assert\NotBlank()
     * @ORM\ManyToMany(targetEntity="Categorie" , inversedBy="products")
     * @ORM\JoinTable(name="products_categories")
     */
    private $categories;

    /**
     * @var datetime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     *
     */
    private $createdAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="updateAt", type="datetime")
     *
     */
    private $updateAt;


    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string")
     *
     */
    private $image;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titleFR
     *
     * @param string $titleFR
     *
     * @return Product
     */
    public function setTitleFR($titleFR)
    {
        $this->titleFR = $titleFR;

        return $this;
    }

    /**
     * Get titleFR
     *
     * @return string
     */
    public function getTitleFR()
    {
        return $this->titleFR;
    }

    /**
     * Set titleEN
     *
     * @param string $titleEN
     *
     * @return Product
     */
    public function setTitleEN($titleEN)
    {
        $this->titleEN = $titleEN;

        return $this;
    }

    /**
     * Get titleEN
     *
     * @return string
     */
    public function getTitleEN()
    {
        return $this->titleEN;
    }

    /**
     * Set descriptionFR
     *
     * @param string $descriptionFR
     *
     * @return Product
     */
    public function setDescriptionFR($descriptionFR)
    {
        $this->descriptionFR = $descriptionFR;

        return $this;
    }

    /**
     * Get descriptionFR
     *
     * @return string
     */
    public function getDescriptionFR()
    {
        return $this->descriptionFR;
    }

    /**
     * Set descriptionEN
     *
     * @param string $descriptionEN
     *
     * @return Product
     */
    public function setDescriptionEN($descriptionEN)
    {
        $this->descriptionEN = $descriptionEN;

        return $this;
    }

    /**
     * Get descriptionEN
     *
     * @return string
     */
    public function getDescriptionEN()
    {
        return $this->descriptionEN;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Product
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set marque
     *
     * @param \adminBundle\Entity\Brand $marque
     *
     * @return Product
     */
    public function setMarque(\adminBundle\Entity\Brand $marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \adminBundle\Entity\Brand
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Add category
     *
     * @param \adminBundle\Entity\Categorie $category
     *
     * @return Product
     */
    public function addCategory(\adminBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \adminBundle\Entity\Categorie $category
     */
    public function removeCategory(\adminBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
