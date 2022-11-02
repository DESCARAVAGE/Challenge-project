<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Language;
use App\Entity\Type;
use App\Entity\Level;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sendSearch', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]
            ])

            ->add('types', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Type::class,
                'expanded' => true,
                'multiple' =>  true,
            ])

            ->add('levels', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Level::class,
                'expanded' => true,
                'multiple' =>  true,
            ])

            ->add('languages', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Language::class,
                'expanded' => true,
                'multiple' =>  true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'methode' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
