<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 7-6-2019
 * Time: 11:55
 */

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;


class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, array(
                'mapped' => false,
                'label'=>'oude wachtwoord'
            ))
            ->add('plainPassword', RepeatedType::class,
                array(
                'type' => PasswordType::class,
                'invalid_message' => 'De wachtwoorden komen niet overeen',
                'options'=>[ 'attr' => array(
                    'class' => 'password-field'
                )],
                'first_options' => array(
                    'label'=>'nieuwe wachtwoord'
                ),

                'second_options'=>array(
                    'label'=>'herhaal',
                    'attr' => array(
                        'class' => 'password-field'
                )),
                'required' => true,
                'mapped' => false
            ))
            ->add('submit', SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-primary btn-block'
                )
            ));
    }
}