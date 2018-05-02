<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', null, [
                'attr' => ['autofocus' => true],
                'label' => 'label.fullName',
                'required' => false,
            ])
            ->add('username', null, [
                'label' => 'label.username',
            ])
            ->add('email', null, [
                'label' => 'label.email',
            ])
            ->add('password', null, [
                'label' => 'label.password',
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
