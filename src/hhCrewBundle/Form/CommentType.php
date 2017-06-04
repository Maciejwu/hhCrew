<?php

namespace hhCrewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('commentText', null, array('label' => 'Twój komentarz');
                ->add('post','entity', array(
                      'class' => 'AppBundle:Post',
                      'choice_label' => 'id',
                      'attr' => array(
                      'class' => 'hidden'),
                      'label' => false,)
                    );
                ->add('user','entity', array(
                      'class' => 'AppBundle:User',
                      'choice_label' => 'id',
                      'attr' => array(
                          'class' => 'hidden'),
                      'label' => false,)
                    );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'hhCrewBundle\Entity\Comment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hhcrewbundle_comment';
    }


}
