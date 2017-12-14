<?php
/**
 * Created by PhpStorm.
 * User: gomes
 * Date: 13/12/17
 * Time: 09:51
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class CategoriaFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('active', ChoiceType::class, [
                'choices' => [
                    'Ativar' => true,
                    'Desativar' => false,
                ]
            ])
            ->add('categoriaScientists', CollectionType::class, [
                'entry_type' => CategoriaScientistEmbedded::class,
                'allow_delete' => true,
                'allow_add' => true,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Categoria'
        ]);
    }

}