<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => "Nom",
                'row_attr' => [
                    'class' => 'input-field'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => "Prénom",
                'row_attr' => [
                    'class' => 'input-field'
                ]
            ])
            ->add('client_type', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    "Particulier / Professionnel" => false,
                    "Un particulier" => "Particulier",
                    "Un professionnel" => "Professionnel",
                ]
            ])
            ->add('secteur', TextType::class, [
                'label' => "Secteur",
                'row_attr' => [
                    'class' => 'input-field'
                ]
            ])
            ->add('code_postal', TextType::class, [
                'label' => "Code postal",
                'row_attr' => [
                    'class' => 'input-field'
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => "Ville",
                'row_attr' => [
                    'class' => 'input-field'
                ]
            ])
            ->add('telephone', TelType::class, [
                'label' => "Téléphone",
                'row_attr' => [
                    'class' => 'input-field'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "E-Mail",
                'row_attr' => [
                    'class' => 'input-field'
                ]
            ])
            ->add('services', ChoiceType::class, [
                'label' => "Je suis intéressé par :",
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    "Conception d'identité visuelle" => "Conception d'identité visuelle",
                    "Signature de marque" => "Signature de marque",
                    "Supports print" => "Supports print",
                    "Reportage photo" => "Reportage photo",
                    "Création de site internet" => "Création de site internet",
                    "Création d'application mobile" => "Création d'application mobile",
                    "Boutique E-Commerce" => "Boutique E-Commerce",
                    "Campagne d'E-Mailing" => "Campagne d'E-Mailing",
                    "Référencement naturel SEO" => "Référencement naturel SEO"
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => "Message",
                'row_attr' => [
                    'class' => 'input-field'
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
            // Configure your form options here
        ]);
    }
}
