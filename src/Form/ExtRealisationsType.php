<?php

namespace App\Form;

use App\Entity\ExtPartenaires;
use App\Entity\ExtRealisations;
use App\Entity\ExtServices;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ExtRealisationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('main_image', DropzoneType::class, [
                'label' => "Image principale",
                'required' => false,
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => "Client (Nom ou raison sociale)",
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('website', UrlType::class, [
                'label' => "URL du site (si existante)",
                'required' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('annee', NumberType::class, [
                'label' => "Année de livraison",
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('youtube', TextType::class, [
                'label' => "Vidéo Youtube (si existante)",
                'required' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('services', EntityType::class, [
                'class' => ExtServices::class,
                'label' => "Services proposés",
                'choice_label' => 'titre[0]',
                'multiple' => true,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('partenaires', EntityType::class, [
                'class' => ExtPartenaires::class,
                'label' => "Partenaires du projet",
                'choice_label' => 'societe',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('intro', CKEditorType::class, [
                'label' => "Introduction",
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('demande', CKEditorType::class, [
                'label' => "Demande",
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('approche', CKEditorType::class, [
                'label' => "Approche",
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Enregistrer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExtRealisations::class,
        ]);
    }
}
