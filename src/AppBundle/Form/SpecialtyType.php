<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Specialty type.
 */
class SpecialtyType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('certifyingOrganization', EntityType::class, array(
                'required' => false,
                'class' => 'AppBundle\Entity\Organisation',
                'choice_label' => 'uniqueName',
            ))
            ->add('name', TextType::class, array('required' => false))
            ->add('registrationNumber', TextType::class, array('required' => false))
            ->add('dateObtained', DateType::class, array('required' => false, 'years' => range(date('Y'), date('Y') - 70)))
            ->add('instructorName', TextType::class, array('required' => false))
            ->add('instructorRegistrationNumber', TextType::class, array('required' => false))
        ;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Specialty',
        ));
    }
}
