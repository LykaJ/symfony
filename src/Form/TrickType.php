<?php

namespace App\Form;

use App\Dto\TrickDTO;
use App\Entity\Category;
use App\Entity\Trick;
use App\Repository\CategoryRepository;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'mapped' => false,
            ])
            ->add('content')
           ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'query_builder' => function (CategoryRepository $repo) {
                    return $repo->createQueryBuilder('c')
                        ->where('c.id > :id')
                        ->setParameter('id', 0);
                },
            ])
            ->add('uploadedImage', FileType::class, [
                    'label' => 'Image de l\'article',
                    'required' => false,
                ]
            )
            ->add('mediaVideos', CollectionType::class, [
                'entry_type' => VideoMediaType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ])

            ->add('mediaImages', CollectionType::class, [
                'entry_type' => ImageMediaType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TrickDTO::class,
            'translation_domain' => 'forms',
            'empty_data' => function(FormInterface $form) {
                return new TrickDTO(
                  $form->get('title')->getData(),
                  $form->get('content')->getData(),
                  $form->get('uploadedImage')->getData(),
                  $form->get('category')->getData(),
                  $form->get('mediaVideos')->getData(),
                  $form->get('mediaImages')->getData()

                );
            }
        ]);
    }
}
