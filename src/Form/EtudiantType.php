<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Chambre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule', null, [
                'attr'=>[
                    'readonly' => true
                ],
                'label' => false
            ])
            ->add('prenom', null, ['label' => false])
            ->add('nom', null, ['label' => false])
            ->add('datenaissance', null, [
                'label' => false,
                'widget' => 'single_text'
            ])
            ->add('tel', TextType::class, [
                'label' => false
            ])
            ->add('email', null, ['label' => false])
            ->add('typeetudiant', ChoiceType::class, [
                'choices' => [
                    'Selectionnez le type' => "",
                    'Boursier logé' => "boursierloge",
                    'Boursier non logé' => "boursiernonloge",
                    'Non boursier' => "nonboursier"
                ],
                'label' => false
                ])
            ->add('departement', ChoiceType::class, [
                'choices' => [
                    'Selectionnez le Departement' => "",
                    'Histoire' => "histoire",
                    'Informatique' => "informatique",
                    'Droit' => "droit",
                    'Biologie' => "biologie",
                    'Gestion' => "gestion",
                    'Medecine' => "medecine"
                ],
                'label' => false
                ])
            ->add('adresse', null, [
                'label' => false,
                'required' => false
                ])
            ->add('chambre' , EntityType::class,[
                'class' => Chambre::class,
                'choice_label' => 'numchambre',
                'label' => false
            ],)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
