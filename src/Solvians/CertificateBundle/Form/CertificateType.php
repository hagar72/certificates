<?php

namespace Solvians\CertificateBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CertificateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isin')
            ->add('tradingMarket')
            ->add('currency', 'entity', array(
                'class' => 'SolviansCertificateBundle:Currency',
                'property' => 'currency',
                'empty_value' => 'Select a currency',
            ))
            ->add('issuer')
            ->add('issuingPrice')
            ->add('currentPrice', 'text', array('mapped' => false, 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Solvians\CertificateBundle\Entity\Certificate'
        ));
    }
}
