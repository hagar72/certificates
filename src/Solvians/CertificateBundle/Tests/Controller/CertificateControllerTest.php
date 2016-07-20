<?php

namespace Solvians\CertificateBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Solvians\CertificateBundle\Entity\Certificate;

class CertificateControllerTest extends WebTestCase
{
    private $client;
    
    private $container;
    
    private $em;
    
    public function __construct($name = null, array $data = array(), $dataName = '') {
        $this->client = static::createClient();
        
        $this->container = $this->client->getContainer();
        
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function testCreateNewCertificate()
    {
        // Create a new entry in the database
        $crawler = $this->client->request('GET', '/certificates/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /certificates/");
        $crawler = $this->client->click($crawler->selectLink('Create a new entry')->link());

        $currency = $this->em->getRepository('SolviansCertificateBundle:Currency')->findOneBy(array());
        // Fill in the form and submit it
        $isin = rand(1,999);
        $form = $crawler->selectButton('Create')->form(array(
            'certificate[isin]'  => $isin,
            'certificate[tradingMarket]'  => 'London',
            'certificate[currency]'  => $currency->getId(),
            'certificate[issuer]'  => 'Hagar',
            'certificate[issuingPrice]'  => '33.3',
            'certificate[currentPrice]'  => '36',
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        
        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("' . $isin . '")')->count(), 'Missing element td:contains("Test")');
    }
    
    public function testEditExistCertificate() {
        
        $currency = $this->em->getRepository('SolviansCertificateBundle:Currency')->findOneBy(array());
        $certificate = new Certificate();
        $certificate->setIsin(rand(1,10000));
        $certificate->setCurrency($currency);
        $certificate->setIssuer('Hagar');
        $certificate->setIssuingPrice('50.1');
        $certificate->setTradingMarket('Paris');
        $this->em->persist($certificate);
        $this->em->flush();
        $this->em->refresh($certificate);
        
        // Edit the entity
        $crawler = $this->client->request('GET', '/certificates/' . $certificate->getId() . '/edit');
        
        $isin = rand(1,324344);
        $form = $crawler->selectButton('Edit')->form(array(
            'certificate[isin]'  => $isin,
            'certificate[tradingMarket]'  => 'Bar',
            'certificate[currency]'  => $currency->getId(),
            'certificate[issuer]'  => 'Foo',
            'certificate[issuingPrice]'  => '32.3',
            'certificate[currentPrice]'  => '34',
        ));

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Bar")')->count(), 'Missing element [value="Bar"]');
    }
    
    public function testDeleteAction() {
        
        $currency = $this->em->getRepository('SolviansCertificateBundle:Currency')->findOneBy(array());
        $certificate = new Certificate();
        $certificate->setIsin(rand(1,10000));
        $certificate->setCurrency($currency);
        $certificate->setIssuer('Hagar');
        $certificate->setIssuingPrice('50.1');
        $certificate->setTradingMarket('Paris');
        $this->em->persist($certificate);
        $this->em->flush();
        $this->em->refresh($certificate);
        
        // Edit the entity
        $crawler = $this->client->request('GET', '/certificates/' . $certificate->getId());
        
        // Delete the entity
        $this->client->submit($crawler->selectButton('Delete')->form());
        $crawler = $this->client->followRedirect();
        
        $deletedCertifcate = $this->em->getRepository('SolviansCertificateBundle:Certificate')->findOneBy(array('id' => $certificate->getId()));
        $this->assertNotInstanceOf('Solvians\CertificateBundle\Entity\Certificate', $deletedCertifcate);
    }
}
