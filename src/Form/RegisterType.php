<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstname',TextType::class,[
                'label'=>'Votre prénom',
                'constraints'=>new Length(3,3,30),
                'attr'=>[
                    'placeholder'=>'merci de saisir votre prénom'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label'=>'Votre nom',
                'constraints'=>new Length(3,3,30),
                'attr'=>[
                    'placeholder'=>'merci de saisir votre nom'
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=>'Votre email',
                'constraints'=>new Length(3,3,60),
                'attr'=>[
                    'placeholder'=>'merci de saisir votre email'
                ]
            ])
//            ->add('roles')
            ->add('password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'le mot de passe et la confirmation doit etre identique',
                'required'=>true,
                'first_options'=>['label'=>"mot de passe "],
                'second_options'=>['label'=>"confirmation de mot de passe "],
                'label'=>'Votre mot de passe',
                'attr'=>[
                    'placeholder'=>'merci de saisir votre mot de passe'
                ]
            ])
//            Repeatype instead
//            ->add('confirmer_password',PasswordType::class,[
//                'label'=>'Confirmer Votre mot de passe',
//                //cette proprite ne lie pas amon entité
//                'mapped'=>false,
//                'attr'=>[
//                    'placeholder'=>'merci de saisir votre mot de passe'
//                ]
//            ])
            ->add('submit',SubmitType::class,[
                'label'=>'inscrire'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
