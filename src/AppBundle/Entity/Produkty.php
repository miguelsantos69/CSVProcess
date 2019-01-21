<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produkty
 *
 * @ORM\Table(name="produkty")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduktyRepository")
 */
class Produkty
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
     * @ORM\Column(name="kod_produktu", type="integer")
     */
    private $kodProduktu;

    /**
     * @var int
     *
     * @ORM\Column(name="ilosc", type="integer")
     */
    private $ilosc;

    /**
     * @var int
     *
     * @ORM\Column(name="rok_produkcji", type="integer")
     */
    private $rokProdukcji;

    /**
     * @var float
     *
     * @ORM\Column(name="cena", type="float")
     */
    private $cena;
    
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
     * Set kodProduktu
     *
     * @param integer $kodProduktu
     *
     * @return Produkty
     */
    public function setKodProduktu($kodProduktu)
    {
        $this->kodProduktu = $kodProduktu;

        return $this;
    }

    /**
     * Get kodProduktu
     *
     * @return int
     */
    public function getKodProduktu()
    {
        return $this->kodProduktu;
    }

    /**
     * Set ilosc
     *
     * @param integer $ilosc
     *
     * @return Produkty
     */
    public function setIlosc($ilosc)
    {
        $this->ilosc = $ilosc;

        return $this;
    }

    /**
     * Get ilosc
     *
     * @return int
     */
    public function getIlosc()
    {
        return $this->ilosc;
    }

    /**
     * Set rokProdukcji
     *
     * @param integer $rokProdukcji
     *
     * @return Produkty
     */
    public function setRokProdukcji($rokProdukcji)
    {
        $this->rokProdukcji = $rokProdukcji;

        return $this;
    }

    /**
     * Get rokProdukcji
     *
     * @return int
     */
    public function getRokProdukcji()
    {
        return $this->rokProdukcji;
    }

    /**
     * Set cena
     *
     * @param float $cena
     *
     * @return Produkty
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

        return $this;
    }

    /**
     * Get cena
     *
     * @return float
     */
    public function getCena()
    {
        return $this->cena;
    }
}

