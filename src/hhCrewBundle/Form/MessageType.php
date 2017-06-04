<?php

namespace hhCrewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', null, array('label'=>'Tytuł')))
                ->add('messageText', null, array('label'=>'Treść wiadomości')))
                ->add('nadawca', null, array(
                    'attr' => array(
                        'class' => 'hidden'
                    ),
                    'label' => false
                ))
                ->add('odbiorca', null, array(
                    'attr' => array(
                        'class' => 'hidden'
                    ),
                    'label' => false
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hhCrewBundle\Entity\Message'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hhcrewbundle_message';
    }


}
