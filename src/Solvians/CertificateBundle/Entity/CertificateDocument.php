<?php

namespace Solvians\CertificateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CertificateDocument
 *
 * @ORM\Table(name="certificate_documents", indexes={@ORM\Index(name="fk_certificate_documents_certificates1_idx", columns={"certificates_id"})})
 * @ORM\Entity
 */
class CertificateDocument
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="document_name", type="string", length=45, nullable=false)
     */
    private $documentName;

    /**
     * @var \Solvians\CertificateBundle\Entity\Certificate
     *
     * @ORM\ManyToOne(targetEntity="Solvians\CertificateBundle\Entity\Certificate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="certificates_id", referencedColumnName="id")
     * })
     */
    private $certificate;



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
     * Set documentName
     *
     * @param string $documentName
     *
     * @return CertificateDocument
     */
    public function setDocumentName($documentName)
    {
        $this->documentName = $documentName;

        return $this;
    }

    /**
     * Get documentName
     *
     * @return string
     */
    public function getDocumentName()
    {
        return $this->documentName;
    }

    /**
     * Set certificate
     *
     * @param \Solvians\CertificateBundle\Entity\Certificate $certificate
     *
     * @return CertificateDocument
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
