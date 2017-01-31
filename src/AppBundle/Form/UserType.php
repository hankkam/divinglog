<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * User type.
 */
class UserType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, array('required' => false))
            ->add('password', TextType::class, array('required' => false))
            ->add('lastOnline', DateType::class, array('required' => false))
            ->add('expires', DateType::class, array('required' => false))
            ->add('blocked', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => '1',
                    'No' => '0',
                ),
                'expanded' => true,
            ))
        ;
    }
}
