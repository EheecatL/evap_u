<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 2019-01-20
 * Time: 12:54
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends AbstractType
{
    public function buildUserForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);


        $builder
            ->add('firstname', null, array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle'))
            ->add('lastname', null, array('label' => 'form.lastname', 'translation_domain' => 'FOSUserBundle'))
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
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

}