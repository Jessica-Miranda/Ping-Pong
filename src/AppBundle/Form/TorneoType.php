<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TorneoType extends AbstractType
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('fecha_inicio', DateType::class, [
            'html5' => true,
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy'
        ])
        ->add('fecha_fin', DateType::class, [
            'html5' => true,
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy'
        ])

        ->add('nombre')

        ->add('puntos', ChoiceType::class, [
            'label' => 'Punteo por set',
            'choices' => [
                '7' => 7,
                '11' => 11,
                '21'   => 21
            ],

            'preferred_choices' => array('muppets', 'arr')
        ])

        ->add('sets', ChoiceType::class, array(
            'label' => 'Cantidad de sets',
            'choices' => [
                '1' => 1,
                '3' => 3,
                '5'   => 5
                ],
                'preferred_choices' => array('muppets', 'arr')
            ));
        }

        /**
        * {@inheritdoc}
        */
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Torneo'
            ));
        }

        /**
        * {@inheritdoc}
        */
        public function getBlockPrefix()
        {
            return 'appbundle_torneo';
        }


    }
