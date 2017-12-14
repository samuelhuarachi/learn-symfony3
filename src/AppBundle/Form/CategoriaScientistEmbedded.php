<?php

namespace AppBundle\Form;

use AppBundle\Entity\CategoriaScientist;
use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriaScientistEmbedded extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'query_builder' => function(UserRepository $repo) {
                            return $repo->createIsScientistQueryBuilder();
                        }
            ])
            ->add('periodoCategoria');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategoriaScientist::class
        ]);
    }

//    public function getBlockPrefix()
//    {
//        return 'app_bundle_categoria_scientist_embedded';
//    }
}
