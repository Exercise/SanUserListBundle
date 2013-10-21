<?php

namespace San\UserBundle\Form\Type\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Optionsresolver\OptionsResolverInterface;

class DateType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'san_type_filter_date';
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'hidden')
            ->add('value', 'date', array_merge(array(
                'required' => false,
                'widget' => 'single_text'
            ), $options['field_options']))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'field_type'    => 'date',
            'field_options' => array('date_format' => 'dd/mm/yyyy')
        ));
    }
}
