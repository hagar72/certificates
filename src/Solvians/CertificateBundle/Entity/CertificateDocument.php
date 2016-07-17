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
     * @var string
     *
     * @ORM\Column(name="document_name", type="string", length=45)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
    private $certificates;



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
     * Set certificates
     *
     * @param \Solvians\CertificateBundle\Entity\Certificate $certificates
     *
     * @return CertificateDocument
     */
    public function setCertificates(\Solvians\CertificateBundle\Entity\Certificate $certificates = null)
    {
        $this->certificates = $certificates;

        return $this;
    }

    /**
     * Get certificates
     *
     * @return \Solvians\CertificateBundle\Entity\Certificate
     */
    public function getCertificates()
    {
        return $this->certificates;
    }
}
