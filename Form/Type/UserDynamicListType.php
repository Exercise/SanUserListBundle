<?php

namespace San\UserBundle\Form\Type;

use San\UserBundle\Form\Type\FilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserDynamicListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', 'textarea')
        ;
    }

    public function getName()
    {
        return 'UserDynamicList';
    }
}
