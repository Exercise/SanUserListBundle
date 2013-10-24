<?php

namespace San\UserBundle\Form\Type;

use San\UserBundle\Form\Type\FilterValueType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilterType extends AbstractType
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
    public function getName()
    {
        return 'san_list_filter';
    }
}
