<?php

namespace Solvians\CertificateBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Solvians\CertificateBundle\Entity\Currency;
use Solvians\CertificateBundle\Form\CurrencyType;

/**
 * Currency controller.
 *
 * @Route("/currencies")
 */
class CurrencyController extends Controller
{
    /**
     * Lists all Currency entities.
     *
     * @Route("/", name="currencies_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $currencies = $em->getRepository('SolviansCertificateBundle:Currency')->findAll();

        return $this->render('currency/index.html.twig', array(
            'currencies' => $currencies,
        ));
    }

    /**
     * Creates a new Currency entity.
     *
     * @Route("/new", name="currencies_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $currency = new Currency();
        $form = $this->createForm('Solvians\CertificateBundle\Form\CurrencyType', $currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($currency);
            $em->flush();

            return $this->redirectToRoute('currencies_show', array('id' => $currency->getId()));
        }

        return $this->render('currency/new.html.twig', array(
            'currency' => $currency,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Currency entity.
     *
     * @Route("/{id}", name="currencies_show")
     * @Method("GET")
     */
    public function showAction(Currency $currency)
    {
        $deleteForm = $this->createDeleteForm($currency);

        return $this->render('currency/show.html.twig', array(
            'currency' => $currency,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Currency entity.
     *
     * @Route("/{id}/edit", name="currencies_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Currency $currency)
    {
        $deleteForm = $this->createDeleteForm($currency);
        $editForm = $this->createForm('Solvians\CertificateBundle\Form\CurrencyType', $currency);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($currency);
            $em->flush();

            return $this->redirectToRoute('currencies_edit', array('id' => $currency->getId()));
        }

        return $this->render('currency/edit.html.twig', array(
            'currency' => $currency,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Currency entity.
     *
     * @Route("/{id}", name="currencies_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Currency $currency)
    {
        $form = $this->createDeleteForm($currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($currency);
            $em->flush();
        }

        return $this->redirectToRoute('currencies_index');
    }

    /**
     * Creates a form to delete a Currency entity.
     *
     * @param Currency $currency The Currency entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Currency $currency)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('currencies_delete', array('id' => $currency->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
