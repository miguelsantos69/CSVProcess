<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historia
 *
 * @ORM\Table(name="historia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HistoriaRepository")
 */
class Historia {

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
     * @ORM\Column(name="pliki", type="integer")
     */
    private $pliki;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $ostatniImport;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    function getOstatniImport() {
        return $this->ostatniImport;
    }

    function setOstatniImport(\DateTime $ostatniImport) {
        $this->ostatniImport = $ostatniImport;
    }

    public function __construct() {
        $this->ostatniImport = new \DateTime();
    }

    public function __toString() {

        return $this->ostatniImport;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set pliki
     *
     * @param integer $pliki
     *
     * @return Historia
     */
    public function setPliki($pliki) {
        $this->pliki = $pliki;

        return $this;
    }

    /**
     * Get pliki
     *
     * @return int
     */
    public function getPliki() {
        return $this->pliki;
    }

}
