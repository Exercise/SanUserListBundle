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
            ->add('name')
            ->add('value', new FilterValueType())
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sonata\AdminBundle\Filter\Filter'
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'UserStaticList';
    }
}
