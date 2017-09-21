<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
* Class AdminUsuarioType
* @package AppBundle\Form
*/
class AdminUsuarioType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
        ->add('nombreImpresion', TextType::class, ['label' => 'Nombre completo'])
        ->add('username', TextType::class, ['label' => 'Nombre de usuario'])
        ->add('email', EmailType::class, ['label' => 'Email'])
        ->add('plainPassword', RepeatedType::class,
            [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Contraseña'],
                'second_options' => ['label' => 'Confirme contraseña'],
                'invalid_message' => 'fos_user.password.mismatch',
            ]
        )
        ->add('enabled', CheckboxType::class, [
            'required' => false,
        ])
        ->add(
                'roles',
                ChoiceType::class,
                [
                     'multiple' => true,
                     'attr' => ['class' => 'select-chosen'],
                    'choices' => [
                        'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        'ROLE_USER' => 'ROLE_USER',
                        'ROLE_SELLER' => 'ROLE_SELLER',
                    ],
                ]
            );
    }

    /**
    * @param OptionsResolver $resolver
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario',
            'intention' => 'registration',
        ));
    }
    /**
    * @return string
    */
    public function getName()
    {
        return 'adminRegistration_type';
    }
}
