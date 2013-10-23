<?php

namespace San\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilterValueType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('value')
        ;
    }

    /**
     * {@inheritDoc}
     */
    // public function setDefaultOptions(OptionsResolverInterface $resolver)
    // {
    //     $resolver->setDefaults(array(
    //         'data_class' => 'Sonata\AdminBundle\Filter\Filter'
    //     ));
    // }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'FilterValue';
    }
}
