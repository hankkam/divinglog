<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Diver log type.
 */
class DiveLogType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('number', IntegerType::class)
            ->add('timein', TimeType::class, array('data' => new \DateTime('now')))
            ->add('timeout', TimeType::class, array('data' => new \DateTime('now')))
            ->add('date', DateType::class, array('data' => new \DateTime('now')))
            ->add('country', CountryType::class, array('placeholder' => 'Choose a country...',))
            ->add('location', TextType::class)
            ->add('divesite', TextType::class, array('required' => false, 'label' => 'Dive site name'))
            ->add('lat', TextType::class, array('required' => false, 'label' => 'Latitude'))
            ->add('lng', TextType::class, array('required' => false, 'label' => false))
        ;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DiveLog',
        ));
    }
}
