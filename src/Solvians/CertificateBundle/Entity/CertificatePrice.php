<?php

namespace Solvians\CertificateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CertificatePrice
 *
 * @ORM\Table(name="certificate_prices", indexes={@ORM\Index(name="fk_certificate_prices_certificates1_idx", columns={"certificates_id"})})
 * @ORM\Entity
 */
class CertificatePrice
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=45, nullable=true)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    private $createdDate;

    /**
     * @var \Solvians\CertificateBundle\Entity\Certificate
     *
     * @ORM\OneToOne(targetEntity="Solvians\CertificateBundle\Entity\Certificate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="certificates_id", referencedColumnName="id", unique=true)
     * })
     */
    private $certificate;

    public function __construct() {
        // we set up "created"+"modified"
        $this->setCreatedDate(new \DateTime());
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return CertificatePrice
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
     * Set price
     *
     * @param string $price
     *
     * @return CertificatePrice
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return CertificatePrice
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set certificates
     *
     * @param \Solvians\CertificateBundle\Entity\Certificate $certificate
     *
     * @return CertificatePrice
     */
    public function setCertificate(\Solvians\CertificateBundle\Entity\Certificate $certificate = null)
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * Get certificate
     *
     * @return \Solvians\CertificateBundle\Entity\Certificate
     */
    public function getCertificate()
    {
        return $this->certificate;
    }
}
