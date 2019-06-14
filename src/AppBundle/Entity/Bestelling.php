<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bestelling
 *
 * @ORM\Table(name="bestelling")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestellingRepository")
 */
class Bestelling
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
     * @ORM\OneToMany(targetEntity="BestellingRegel", mappedBy="bestellingen")
     */
    private $bestellingregel;


    /**
     * @var string
     *
     * @ORM\Column(name="klant", type="string", length=255)
     */
    private $klant;

    /**
     * @var string
     *
     * @ORM\Column(name="telefoon", type="string", length=255)
     */
    private $telefoon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="afleverdatum", type="date")
     */
    private $afleverdatum;


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
     * Set klant
     *
     * @param string $klant
     *
     * @return Bestelling
     */
    public function setKlant($klant)
    {
        $this->klant = $klant;

        return $this;
    }

    /**
     * Get klant
     *
     * @return string
     */
    public function getKlant()
    {
        return $this->klant;
    }

    /**
     * Set telefoon
     *
     * @param string $telefoon
     *
     * @return Bestelling
     */
    public function setTelefoon($telefoon)
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    /**
     * Get telefoon
     *
     * @return string
     */
    public function getTelefoon()
    {
        return $this->telefoon;
    }

    /**
     * Set afleverdatum
     *
     * @param \DateTime $afleverdatum
     *
     * @return Bestelling
     */
    public function setAfleverdatum($afleverdatum)
    {
        $this->afleverdatum = $afleverdatum;

        return $this;
    }

    /**
     * Get afleverdatum
     *
     * @return \DateTime
     */
    public function getAfleverdatum()
    {
        return $this->afleverdatum;
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

