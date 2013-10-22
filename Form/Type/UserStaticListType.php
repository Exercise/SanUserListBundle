<?php

namespace San\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserStaticListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', 'textarea')
            // ->add('type', 'choice', array(
            //     'mapped'  => false,
            //     'choices' => UserList::$types,
            // ))
            ->add('users', 'san_user_list')
        ;
    }

    public function getName()
    {
        return 'UserStaticList';
    }
}
