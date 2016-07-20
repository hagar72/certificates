<?php

namespace Solvians\CertificateBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('currency', EntityType::class, array(
                'class' => 'SolviansCertificateBundle:Currency',
                'choice_label' => 'currency',
                'placeholder' => 'Select a currency',
            ))
            ->add('issuer')
            ->add('issuingPrice')
            ->add('currentPrice', TextType::class, array('mapped' => false))
            ->add('certificateDocument', FileType::class, array('mapped' => false, 'data_class' => null, 'required' => false))
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
