<?php


namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('age', IntegerType::class)
            ->add('description', TextareaType::class)
            ->add('products', EntityType::class, [
                'class' => 'AppBundle\Entity\Products',
                'multiple' => 'true',
                'expanded' => 'true',
                'choice_label' => 'name',
                'label' => 'Produit favori',
            ])
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}

