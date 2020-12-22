<?php

namespace App\Form;

use App\Entity\Matiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomMat')
            ->add('prixMat')
            ->add('imgMat', FileType::class, [
                'label' =>false,
                'multiple' => false,
                'mapped' => false

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
        ]);
    }
}
