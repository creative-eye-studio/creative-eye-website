<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\ExtServices;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ExtServicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => "Titre du service",
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('sous_titre', TextType::class, [
                'label' => "Sous-titre du service",
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('categorie', EntityType::class, [
                'label' => "Catégorie",
                'class' => Categories::class,
                'choice_label' => 'nom',
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('thumb', DropzoneType::class, [
                'label' => "Image du service",
                'required' => false,
                'data_class' => null,
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('intro', CKEditorType::class, [
                'label' => "Introduction (A retirer)",
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('contenu', CKEditorType::class, [
                'label' => "Présentation du service",
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('services', TextType::class, [
                'label' => "Liste des services",
                'mapped' => false,
                'attr' => [
                    'placeholder' => "Ex : Service 1; Service 2"
                ],
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExtServices::class,
        ]);
    }
}
