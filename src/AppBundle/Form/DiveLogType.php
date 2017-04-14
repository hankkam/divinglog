<?php

namespace AppBundle\Form;

use AppBundle\Form\DataTransformer\BinaryValueToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
    /** @var array  */
    private $choices = array(
        'choices' => array(
            'River' => 1,
            'Lake' => 2,
            'Ocean' => 4,
            'Boat' => 8,
            'Shore' => 16,
            'Drift' => 32,
            'Night' => 64,
            'Ice' => 128,
            'Cave' => 256,
            'Deco' => 512,
        )
    );

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('number', IntegerType::class)
            ->add('timein', TimeType::class, array('label' => 'Time in', 'data' => new \DateTime('now')))
            ->add('timeout', TimeType::class, array('label' => 'Time out', 'data' => new \DateTime('now')))
            ->add('date', DateType::class, array('data' => new \DateTime('now')))
            ->add('country', CountryType::class, array('placeholder' => 'Choose a country...',))
            ->add('location', TextType::class)
            ->add('diveSite', TextType::class, array('label' => 'Dive site name'))
            ->add('lat', TextType::class, array('required' => false, 'label' => 'Latitude'))
            ->add('lng', TextType::class, array('required' => false, 'label' => 'Longitude'))
            ->add('airtemperature', TextType::class, array('label' => 'Air temp.'))
            ->add('watertemperature', TextType::class, array('label' => 'Water temp.'))
            ->add('altitude', TextType::class)
            ->add('visibility', TextType::class)
            ->add('weight', TextType::class)
            ->add('tank', TextType::class)
            ->add('tanksize', TextType::class)
            ->add('airpressurestart', TextType::class, array('label' => 'Start Bar.' ))
            ->add('airpressureend', TextType::class, array('label' => 'End Bar' ))
            ->add('environment', ChoiceType::class, array('multiple' => true, 'expanded' => true,
                'choices' => array(
                    'River' => 1,
                    'Lake' => 2,
                    'Ocean' => 4,
                    'Boat' => 8,
                    'Shore' => 16,
                    'Drift' => 32,
                    'Night' => 64,
                    'Ice' => 128,
                    'Cave' => 256,
                    'Deco' => 512,
                )
            ))
            ->add('tide', ChoiceType::class, array('multiple' => true, 'expanded' => true,
                'choices' => array(
                    'Waves' => 1,
                    'Surf' => 2,
                    'Surge' => 4,
                    'Swells' => 8,
                    'Mild Current' => 16,
                    'Strong Current' => 32,
                )
            ));

        $builder->get('environment')
            ->addModelTransformer(new BinaryValueToArrayTransformer(
                function ($binaryValueAsArray) {
                    // transform the binary value to an array
                    return $binaryValueAsArray;
                },
                function ($arrayAsBinaryValue) {
                    // transform the string back to an array
                    return $arrayAsBinaryValue;
                }
        ));

        $builder->get('tide')
            ->addModelTransformer(new BinaryValueToArrayTransformer(
                function ($binaryValueAsArray) {
                    // transform the binary value to an array
                    return $binaryValueAsArray;
                },
                function ($arrayAsBinaryValue) {
                    // transform the string back to an array
                    return $arrayAsBinaryValue;
                }
        ));

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
