<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', null, [
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                    ],
                'label' => 'Full name',
            ])
            ->add('username', null, [
                'label' => 'Username',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('email', null, [
                'label' => 'Email adress',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            /*->add('roles', null, [
                'label' => 'label.roles',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
