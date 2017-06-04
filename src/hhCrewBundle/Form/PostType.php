<?php

namespace hhCrewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array('label' => 'Tytuł ogłoszenia'))
                ->add('city', null, array('label' => 'miasto'))
                ->add('description', null, array('label' => 'opis ogłoszenia'))
                ->add('user','entity', array(
                    'class' => 'AppBundle:User',
                    'choice_label' => 'id',
                    'attr' => array(
                        'class' => 'hidden'
                    ),
                    'label' => false,
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hhCrewBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hhcrewbundle_post';
    }


}
