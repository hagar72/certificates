<?php

namespace Solvians\CertificateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Certificate
 *
 * @ORM\Table(name="certificates", indexes={@ORM\Index(name="fk_certificates_table11_idx", columns={"currency"})})
 * @ORM\Entity
 */
class Certificate
{
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="isin", type="string", length=45, nullable=true)
     */
    private $isin;

    /**
     * @var string
     *
     * @ORM\Column(name="trading_market", type="string", length=45, nullable=true)
     */
    private $tradingMarket;

    /**
     * @var string
     *
     * @ORM\Column(name="issuer", type="string", length=45, nullable=true)
     */
    private $issuer;

    /**
     * @var string
     *
     * @ORM\Column(name="issuing_price", type="string", length=45, nullable=true)
     */
    private $issuingPrice;

    /**
     * @var \Solvians\CertificateBundle\Entity\Currency
     *
     * @ORM\OneToOne(targetEntity="Solvians\CertificateBundle\Entity\Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency", referencedColumnName="id", unique=true)
     * })
     */
    private $currency;



    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Certificate
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set isin
     *
     * @param string $isin
     *
     * @return Certificate
     */
    public function setIsin($isin)
    {
        $this->isin = $isin;

        return $this;
    }

    /**
     * Get isin
     *
     * @return string
     */
    public function getIsin()
    {
        return $this->isin;
    }

    /**
     * Set tradingMarket
     *
     * @param string $tradingMarket
     *
     * @return Certificate
     */
    public function setTradingMarket($tradingMarket)
    {
        $this->tradingMarket = $tradingMarket;

        return $this;
    }

    /**
     * Get tradingMarket
     *
     * @return string
     */
    public function getTradingMarket()
    {
        return $this->tradingMarket;
    }

    /**
     * Set issuer
     *
     * @param string $issuer
     *
     * @return Certificate
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * Get issuer
     *
     * @return string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * Set issuingPrice
     *
     * @param string $issuingPrice
     *
     * @return Certificate
     */
    public function setIssuingPrice($issuingPrice)
    {
        $this->issuingPrice = $issuingPrice;

        return $this;
    }

    /**
     * Get issuingPrice
     *
     * @return string
     */
    public function getIssuingPrice()
    {
        return $this->issuingPrice;
    }

    /**
     * Set currency
     *
     * @param \Solvians\CertificateBundle\Entity\Currency $currency
     *
     * @return Certificate
     */
    public function setCurrency(\Solvians\CertificateBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Solvians\CertificateBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
