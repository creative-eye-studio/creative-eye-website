<?php

namespace App\Form;

use App\Entity\ExtPartenaires;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ExtPartenairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom",
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('societe', TextType::class, [
                'label' => "Société",
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('website', UrlType::class, [
                'label' => "Site Internet",
                'required' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('logo', DropzoneType::class, [
                'label' => "Logo",
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('photo', DropzoneType::class, [
                'label' => "Image du gérant",
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('texte', CKEditorType::class, [
                'label' => "Texte de présentation",
                'mapped' => false,
                'row_attr' => [
                    'class' => "form-row"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer"
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExtPartenaires::class,
        ]);
    }
}
