<?php

namespace App\Form;

use App\Entity\Climb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ClimbCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir un nom"
                    ])
                ]
            ])
            ->add('date', DateType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir une date"
                    ])
                ]
            ])
            ->add('image', FileType::class, ['required' => false])
            ->add('description', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir une description"
                    ])
                ]
            ])
            ->add('localisation', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir une adresse"
                    ])
                ]
            ])
            ->add('requireRank', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir un rang minimum"
                    ])
                ]
            ])
            ->add('maxUser', IntegerType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir un nombre de participant"
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Climb::class,
        ]);
    }
}
