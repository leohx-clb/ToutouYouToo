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
        $buil
            ->add('history',TextareaType::class , [
                'label' => 'Historique ',
                'required' => false,
            ])
            ->add('lof', CheckboxType::class, [
                'label' => 'Chien L.O.F ? ',
                'required' => false,
            ])
            ->add('description', TextareaType::class)
            ->add('animalsFriendly', CheckboxType::class , [
                'label' => 'Accepte les autres ? ',
                'required' => false,

            ])
            ->add('name', TextType::class, [
                'label' => 'Nom ',
            ])
            ->add('sex', TextType::class,[
                'label' => 'Sexe ',
            ])
            ->add('races', EntityType::class, [
                'label' => 'Race(s) de l\'animal ',
                'class' => Race::class,
                //  'choice_label' => 'name',  // commenté car un toString sur Race le remplace
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
