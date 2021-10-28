<?php

namespace App\Form;

use App\Entity\Dog;
use App\Entity\Race;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('history',TextareaType::class )
            ->add('lof', CheckboxType::class)
            ->add('description', TextareaType::class)
            ->add('animalsFriendly', CheckboxType::class )
            ->add('name', TextType::class)
            ->add('sex', CheckboxType::class)
            ->add('races', EntityType::class, [
                'class' => Race::class,
              //  'choice_label' => 'name',  // commenté car un toString Race
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
            'submit' => false,
        ]);
        $resolver->setRequired([
            'submit',
        ]);

    }
}
