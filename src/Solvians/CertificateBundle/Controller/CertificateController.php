<?php

namespace Solvians\CertificateBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Solvians\CertificateBundle\Entity\Certificate;
use Solvians\CertificateBundle\Form\CertificateType;
use Solvians\CertificateBundle\Entity\CertificatePrice;
use Solvians\CertificateBundle\Entity\CertificateDocument;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Certificate controller.
 *
 * @Route("/certificates")
 */
class CertificateController extends Controller
{
    /**
     * Lists all Certificate entities.
     *
     * @Route("/", name="certificates_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $certificates = $em->getRepository('SolviansCertificateBundle:Certificate')->findAll();

        return $this->render('certificate/index.html.twig', array(
            'certificates' => $certificates,
        ));
    }

    /**
     * Creates a new Certificate entity.
     *
     * @Route("/new", name="certificates_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $certificate = new Certificate();
        $form = $this->createForm('Solvians\CertificateBundle\Form\CertificateType', $certificate);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $parameters = $request->request->all();
            $currentPrice = $parameters['certificate']['currentPrice'];
            
            $files = $request->files->all();
            $document = $files['certificate']['certificateDocument'];
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($certificate);
            
            $certificatePrice = new CertificatePrice();
            $certificatePrice->setCertificate($certificate);
            $certificatePrice->setPrice($currentPrice);
            $em->persist($certificatePrice);
            
            $date = new \DateTime();
            $fileName = md5(uniqid() . $date->format('Y-m-d H:s:i')).'.'.$document->guessExtension();

            // Move the file to the directory where brochures are stored
            $document->move($this->getParameter('documentsDirectory'), $fileName);
            
            $certificateDocument = new CertificateDocument();
            $certificateDocument->setCertificate($certificate);
            $certificateDocument->setDocumentName($fileName);
            $em->persist($certificateDocument);
            
            $em->flush();

            return $this->redirectToRoute('certificates_show', array('id' => $certificate->getId()));
        }

        return $this->render('certificate/new.html.twig', array(
            'certificate' => $certificate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Certificate entity.
     *
     * @Route("/{id}", name="certificates_show")
     * @Method("GET")
     */
    public function showAction(Certificate $certificate)
    {
        $deleteForm = $this->createDeleteForm($certificate);

        return $this->render('certificate/show.html.twig', array(
            'certificate' => $certificate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Certificate entity.
     *
     * @Route("/{id}/edit", name="certificates_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Certificate $certificate)
    {
        $deleteForm = $this->createDeleteForm($certificate);
        $editForm = $this->createForm('Solvians\CertificateBundle\Form\CertificateType', $certificate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $parameters = $request->request->all();
            $currentPrice = $parameters['certificate']['currentPrice'];
            
            $files = $request->files->all();
            $document = $files['certificate']['certificateDocument'];
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($certificate);
            
            $certificatePrice = new CertificatePrice();
            $certificatePrice->setCertificate($certificate);
            $certificatePrice->setPrice($currentPrice);
            $em->persist($certificatePrice);
            
            if($document instanceof UploadedFile) {
                $date = new \DateTime();
                $fileName = md5(uniqid() . $date->format('Y-m-d H:s:i')).'.'.$document->guessExtension();

                // Move the file to the directory where brochures are stored
                $document->move($this->getParameter('documentsDirectory'), $fileName);
                $certificateDocument = new CertificateDocument();
                $certificateDocument->setCertificate($certificate);
                $certificateDocument->setDocumentName($fileName);
                $em->persist($certificateDocument);
            }
            
            $em->flush();

            return $this->redirectToRoute('certificates_show', array('id' => $certificate->getId()));
        }

        return $this->render('certificate/edit.html.twig', array(
            'certificate' => $certificate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'certificateCurrentPrice' => $certificate->getLastPrice()
        ));
    }

    /**
     * Deletes a Certificate entity.
     *
     * @Route("/{id}", name="certificates_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Certificate $certificate)
    {
        $form = $this->createDeleteForm($certificate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($certificate);
            $em->flush();
        }

        return $this->redirectToRoute('certificates_index');
    }

    /**
     * Creates a form to delete a Certificate entity.
     *
     * @param Certificate $certificate The Certificate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Certificate $certificate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('certificates_delete', array('id' => $certificate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
