<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\Employees;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employees::class,
        ]);
    }
}
