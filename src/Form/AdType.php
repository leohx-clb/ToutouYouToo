<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Dog;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', \Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label' => 'Titre',
            ])
            ->add('description', \Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label' => 'Description',
            ])
            ->add('dogs', EntityType::class, [
                'label' => 'Chiens de l\'annonce ',
                'class' => Dog::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->where('d.ad is null and d.isAvailable = true')
                        ->orderBy('d.name');
                },
                //  'choice_label' => 'name',  // commenté car un toString sur Race le remplace
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
