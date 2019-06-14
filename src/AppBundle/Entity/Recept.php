<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recept
 *
 * @ORM\Table(name="recept")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReceptRepository")
 */
class Recept
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
     * @ORM\ManyToOne(targetEntity="Fruit", inversedBy="recepten")
     * @ORM\JoinColumn(name="fruit_id", referencedColumnName="id")
     */
    private $fruit;

    /**
     * @ORM\OneToMany(targetEntity="BestellingRegel", mappedBy="recepten")
     */
    private $bestellingregel;


    /**
     * @var string
     *
     * @ORM\Column(name="naam", type="string", length=255)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="prijs_per_liter", type="decimal", precision=5, scale=2)
     */
    private $prijsPerLiter;

    /**
     * @var string
     *
     * @ORM\Column(name="bereidingswijze", type="string", length=255)
     */
    private $bereidingswijze;


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
     * @return Recept
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
     * Set prijsPerLiter
     *
     * @param string $prijsPerLiter
     *
     * @return Recept
     */
    public function setPrijsPerLiter($prijsPerLiter)
    {
        $this->prijsPerLiter = $prijsPerLiter;

        return $this;
    }

    /**
     * Get prijsPerLiter
     *
     * @return string
     */
    public function getPrijsPerLiter()
    {
        return $this->prijsPerLiter;
    }

    /**
     * Set bereidingswijze
     *
     * @param string $bereidingswijze
     *
     * @return Recept
     */
    public function setBereidingswijze($bereidingswijze)
    {
        $this->bereidingswijze = $bereidingswijze;

        return $this;
    }

    /**
     * Get bereidingswijze
     *
     * @return string
     */
    public function getBereidingswijze()
    {
        return $this->bereidingswijze;
    }

    /**
     * @return mixed
     */
    public function getFruit()
    {
        return $this->fruit;
    }

    /**
     * @param mixed $fruit
     */
    public function setFruit($fruit)
    {
        $this->fruit = $fruit;
    }

    /**
     * @return mixed
     */
    public function getBestellingregel()
    {
        return $this->bestellingregel;
    }

    /**
     * @param mixed $bestellingregel
     */
    public function setBestellingregel($bestellingregel)
    {
        $this->bestellingregel = $bestellingregel;
    }
}

