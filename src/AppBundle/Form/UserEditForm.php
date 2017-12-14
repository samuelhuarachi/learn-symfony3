<?php

namespace AppBundle\Form;

use AppBundle\Entity\Categoria;
use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('isScientist')
            ->add('firstName')
            ->add('lastName')
            ->add('universityName')
//            ->add('usersCategorias', EntityType::class, [
//                'class' => Categoria::class,
//                'multiple' => true,
//                'expanded' => true,
//                'choice_label' => 'name',
//                'by_reference' => false
//            ])
            ->add('userAssinaturas', CollectionType::class, [
                'entry_type' => AssinaturaUserEmbedded::class,
//                'allow_delete' => true,
//                'allow_add' => true,
//                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
