<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Diver type.
 */
class DiverType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('initials', TextType::class, array('required' => false))
            ->add('inserts', TextType::class, array('required' => false))
            ->add('lastName', TextType::class, array('required' => false))
            ->add('firstName', TextType::class, array('required' => false))
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Male' => 'Male',
                    'Female' => 'Female',
                ),
                'expanded' => true,
                'required' => false,
            ))
            ->add('dateOfBirth', BirthdayType::class, array('required' => false, 'years' => range(date('Y'), date('Y') - 95)))
            ->add('street', TextType::class, array('label' => 'Street & number', 'required' => false))
            ->add('postalCode', TextType::class, array('required' => false))
            ->add('city', TextType::class, array('required' => false))
            ->add('country', CountryType::class)
            ->add('certificates', CollectionType::class, array(
                'entry_type' => CertificateType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
        ;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Diver',
        ));
    }
}
