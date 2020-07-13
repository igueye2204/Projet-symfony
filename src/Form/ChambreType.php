<?php

namespace App\Form;

use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numchambre', TextType::class, [
                'attr'=>[
                'readonly' => true
                ],
                'label' => false
                ])
            ->add('numbat', NumberType::class, [
                'label' => false
            ])
            ->add('typechambre', ChoiceType::class, [
                'choices' => [
                    'Type de chambre' => "",
                    'individuel' => "individuel",
                    'Adeux' => "Adeux"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
