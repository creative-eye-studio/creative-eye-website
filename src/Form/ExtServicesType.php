<?php

namespace App\Form;

use App\Entity\ExtServices;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
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
                'mapped' => false
            ])
            ->add('sous_titre', TextType::class, [
                'label' => "Sous-titre du service",
                'mapped' => false
            ])
            ->add('thumb', DropzoneType::class, [
                'label' => "Image du service",
                'required' => false,
                'data_class' => null,
                'mapped' => false
            ])
            ->add('intro', CKEditorType::class, [
                'label' => "Introduction",
                'mapped' => false
            ])
            ->add('contenu', CKEditorType::class, [
                'label' => "Présentation du service",
                'mapped' => false
            ])
            ->add('services', TextType::class, [
                'label' => "Liste des services",
                'attr' => [
                    'placeholder' => "Ex : Service 1; Service 2"
                ],
                'mapped' => false
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
