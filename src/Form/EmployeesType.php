<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\Employees;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class EmployeesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('birthday', null, [
                'widget' => 'single_text',
            ])
            ->add('gender')
            ->add('salary')
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'choice_label' => 'department',
            ])
            ->add('experience', TextareaType::class, [
                'required' => false,
                'label' => 'Experience',
                'attr' => [
                    'rows' => 5,  // Imposta l'altezza della textarea
                    'cols' => 50, // Imposta la larghezza della textarea
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employees::class,
        ]);
    }
}
