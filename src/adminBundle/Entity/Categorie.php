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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 300,
     *      maxMessage = "Votre titre doit contenir au maximum {{ limit }} caracteres"
     * )
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
}

