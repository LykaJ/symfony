<?php

namespace App\Form;


use App\Dto\UploadedImageDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadedImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder->add('file', FileType::class, [
            'attr' => [
                'accept' => '.jpg, .jpeg, .png',
            ],
            'label' => false,
            'required' => true
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UploadedImageDTO::class,
            'validation_groups' => ['trickDTO'],
            'error_bubbling' => true,
            'empty_data' => function (FormInterface $form) {
                return new UploadedImageDTO(
                    $form->get('file')->getData()
                );
            }
        ]);
    }
}