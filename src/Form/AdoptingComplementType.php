<?php

namespace App\Form;

use App\Entity\Adopting;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdoptingComplementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('lastName', \Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label' => 'Nom : ',
                'required' => true,
            ])
            ->add('firstName',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label' => 'Prénom : ',
                'required' => true,
            ])
            ->add('phone',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label' => 'Téléphone : ',
                'required' => true,
            ])
            ->add('city');

        if ($options['submit'] === true){
            $builder->add('submit',SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adopting::class,
            'submit' => false,
        ]);
        $resolver->setRequired([
            'submit',
        ]);
    }
}
