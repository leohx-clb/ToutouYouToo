<?php

namespace App\Form;

use App\Entity\Demand;
use App\Entity\Dog;
use Doctrine\ORM\EntityRepository;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $ad = $options['ad'];
        $builder
            ->add('dateDemand')
            ->add('adopting')
            ->add('ad')
            ->add('dogs', EntityType::class, [
                'class' => Dog::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->where('d.ad = $ad and d.isAvailable = true')
                        ->orderBy('d.name');
                },
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
        ;
        if ($options['submit'] === true){
            $builder->add('submit',SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demand::class,
            'submit' => false,
        ]);
    }
}
