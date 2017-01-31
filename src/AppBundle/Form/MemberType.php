<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\UserType;

/**
 * Member type.
 */
class MemberType extends AbstractType
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
            ->add('dateOfBirth', BirthdayType::class, array('required' => false, 'years' => range(date('Y'), date('Y') - 120)))
            ->add('streetName', TextType::class, array('required' => false))
            ->add('streetNumber', TextType::class, array('required' => false))
            ->add('postalCode', TextType::class, array('required' => false))
            ->add('city', TextType::class, array('required' => false))
            ->add('country', TextType::class, array('required' => false))
            ->add('user', UserType::class, array('data_class' => User::class))
        ;
    }
}
