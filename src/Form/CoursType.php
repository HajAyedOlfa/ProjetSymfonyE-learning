<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCours')
            ->add('imgCours', FileType::class, [
                'label' =>false,
                'multiple' => false,
                'mapped' => false,
                'required' => false

            ])
            ->add('matiere', EntityType::class, [
                'class'=> Matiere::class,
                'choice_label'=> 'nomMat'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
