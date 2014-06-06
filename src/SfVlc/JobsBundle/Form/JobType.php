<?php

namespace SfVlc\JobsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('url')
            ->add('link')
            ->add('content')
            ->add('dateCreated')
            ->add('company')
            ->add('tags')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SfVlc\JobsBundle\Entity\Job'
        ));
    }

    public function getName()
    {
        return 'sfvlc_jobsbundle_jobtype';
    }
}
