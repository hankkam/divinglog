<?php

namespace AppBundle\Form;

use AppBundle\Form\DataTransformer\BinaryValueToArrayTransformer;
use Doctrine\DBAL\Types\FloatType;
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
            ->add('location', TextType::class, array('label' => 'Nearest city'))
            ->add('diveSite', TextType::class, array('label' => 'Dive site name'))
            ->add('lat', TextType::class, array('required' => false, 'label' => 'Latitude'))
            ->add('lng', TextType::class, array('required' => false, 'label' => 'Longitude'))
            ->add('airtemperature', TextType::class, array('label' => 'Air temp.', 'required' => false))
            ->add('watertemperature', TextType::class, array('label' => 'Water temp.', 'required' => false))
            ->add('altitude', TextType::class, array('required' => false))
            ->add('visibility', TextType::class, array('required' => false))
            ->add('weight', TextType::class, array('label' => 'Weight (kg)', 'required' => false))
            ->add('tank', ChoiceType::class, array(
                'choices' => array(
                    'Aluminium' => 'Aluminium',
                    'Steel' => 'Steel',
                    'Twin-tanks' => 'Twin-tanks',
                ),
                'expanded' => true,
                'required' => false,
            ))
            ->add('tanksize', ChoiceType::class, array('label' => 'Tanksize (L)',
                'choices' => array(
                    '5' => '5',
                    '5.7' => '5.7',
                    '7' => '7',
                    '8' => '8',
                    '10' => '10',
                    '12' => '12',
                    '15' => '15',
                    '2x7' => '2x7',
                    '2x10' => '2x10',
                    '2x12' => '2x12',
                ),
                'expanded' => true,
                'required' => false,
            ))
            ->add('air', ChoiceType::class, array(
                'choices' => array(
                    'Pressed air' => 'Pressed air',
                    'Nitrox' => 'Nitrox',
                    'Trimix' => 'Trimix',
                    'Heliox' => 'Heliox',
                    'Other' => 'Other',
                ),
                'expanded' => true,
                'required' => false,
            ))
            ->add('tanksize', TextType::class, array('required' => false))
            ->add('airpressurestart', TextType::class, array('label' => 'Start Bar.', 'required' => false))
            ->add('airpressureend', TextType::class, array('label' => 'End Bar', 'required' => false))
            ->add('purpose', ChoiceType::class, array('multiple' => true, 'expanded' => true,
                'choices' => array(
                    'Recreation' => 1,
                    'Training' => 2,
                    'Instruction' => 4,
                    'Guiding' => 8,
                    'Commercial' => 16,
                )
            ))
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
                    'Wreck' => 1024,
                    'Altitude' => 2048,
                )
            ))
            ->add('weather', ChoiceType::class, array('multiple' => true, 'expanded' => true,
                'choices' => array(
                    'Clear' => 1,
                    'Clouds' => 2,
                    'Rain' => 4,
                    'Snow' => 8,
                    'Mist' => 16,
                    'Fog' => 32,
                    'Storm' => 64,
                    'Mild wind' => 128,
                    'Strong wind' => 256,
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
            ))
            ->add('bottom', ChoiceType::class, array('multiple' => true, 'expanded' => true,
                'choices' => array(
                    'Silt' => 1,
                    'Mud' => 2,
                    'Sand' => 4,
                    'Rock' => 8,
                    'Coral' => 16,
                    'Grass' => 32,
                    'Clay' => 64,
                    'Debris' => 128,
                    'Slope' => 256,
                    'Wall' => 512,
                    'Drop-off' => 1024,
                    'none' => 2048,
                )
            ))
            ->add('protection', ChoiceType::class, array('multiple' => true, 'expanded' => true,
                'choices' => array(
                    'Skin' => 1,
                    'Wetsuit' => 2,
                    'Shorty' => 4,
                    'Drysuit' => 8,
                    'Hood' => 16,
                    'Gloves' => 32,
                    'Boots' => 64,
                )
            ))
        ;

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

        $builder->get('purpose')
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

        $builder->get('weather')
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

        $builder->get('bottom')
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

        $builder->get('protection')
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
