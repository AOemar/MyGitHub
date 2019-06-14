<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fruit
 *
 * @ORM\Table(name="fruit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FruitRepository")
 */
class Fruit
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
     * @ORM\OneToMany(targetEntity="Recept", mappedBy="fruit")
     */
    private $recepten;

    /**
     * @var string
     *
     * @ORM\Column(name="naam", type="string", length=255)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="seizoen", type="string", length=255)
     */
    private $seizoen;


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
     * Set naam
     *
     * @param string $naam
     *
     * @return Fruit
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set seizoen
     *
     * @param string $seizoen
     *
     * @return Fruit
     */
    public function setSeizoen($seizoen)
    {
        $this->seizoen = $seizoen;

        return $this;
    }

    /**
     * Get seizoen
     *
     * @return string
     */
    public function getSeizoen()
    {
        return $this->seizoen;
    }

    /**
     * @return mixed
     */
    public function getRecepten()
    {
        return $this->recepten;
    }

    /**
     * @param mixed $recepten
     */
    public function setRecepten($recepten)
    {
        $this->recepten = $recepten;
    }

}

