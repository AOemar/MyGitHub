<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BestellingRegel
 *
 * @ORM\Table(name="bestelling_regel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestellingRegelRepository")
 */
class BestellingRegel
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
     * @var int
     *
     * @ORM\Column(name="aantal", type="integer")
     */
    private $aantal;


    /**
     * @ORM\ManyToOne(targetEntity="Recept", inversedBy="bestellingregel")
     * @ORM\JoinColumn(name="recept_id", referencedColumnName="id")
     */
    private $recepten;

    /**
     * @ORM\ManyToOne(targetEntity="Bestelling", inversedBy="bestellingregel")
     * @ORM\JoinColumn(name="bestelling_id", referencedColumnName="id")
     */
    private $bestellingen;

    /**
     * @return mixed
     */
    public function getBestellingen()
    {
        return $this->bestellingen;
    }

    /**
     * @param mixed $bestellingen
     */
    public function setBestellingen($bestellingen)
    {
        $this->bestellingen = $bestellingen;
    }

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
     * Set aantal
     *
     * @param integer $aantal
     *
     * @return BestellingRegel
     */
    public function setAantal($aantal)
    {
        $this->aantal = $aantal;

        return $this;
    }

    /**
     * Get aantal
     *
     * @return int
     */
    public function getAantal()
    {
        return $this->aantal;
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

