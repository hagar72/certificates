<?php

namespace Solvians\CertificateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $isin;

    /**
     * @var string
     *
     * @ORM\Column(name="trading_market", type="string", length=45, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $tradingMarket;

    /**
     * @var string
     *
     * @ORM\Column(name="issuer", type="string", length=45, nullable=true)
     * @Assert\Type("string")
     */
    private $issuer;

    /**
     * @var string
     *
     * @ORM\Column(name="issuing_price", type="string", length=45, nullable=true)
     * @Assert\NotBlank()
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
     * @ORM\OneToMany(targetEntity="Solvians\CertificateBundle\Entity\CertificatePrice", mappedBy="certificate",cascade={"remove"} )
     * 
     */
    private $priceHistory;

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
    
    /**
     * set price history
     * 
     * @param \Doctrine\Common\Collections\ArrayCollection $priceHistory
     * @return \Solvians\CertificateBundle\Entity\Certificate
     */
    public function setPriceHistory(\Doctrine\Common\Collections\ArrayCollection $priceHistory) {
        $this->priceHistory = $priceHistory;
        return $this;
    }
    
    /**
     * get price history
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection $priceHistory
     */
    public function getPriceHistory() {
        return $this->priceHistory;
    }
    
    /**
     * get last price
     * 
     * @return string $lastPrice
     */
    public function getLastPrice() {
        return $this->getPriceHistory()->last();
    }
}
