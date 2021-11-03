<?php

namespace App\Form;

use App\Entity\Marketer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class,[
                'required' => true,
                'label' => 'Nom',
            ])
            ->add('firstName',TextType::class,[
                'required' => true,
                'label' => 'Prénom',
            ])
            ->add('email',TextType::class,[
                'required' => true,
                'label' => 'Email',
            ])
            ->add('password',TextType::class,[
                'required' => true,
                'label' => 'Mot de passe',
            ])
            ->add('name',TextType::class,[
                'required' => true,
                'label' => 'Nom',
            ])
            ->add('city')
            ->add('typeMarketer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Marketer::class,
        ]);
    }
}
