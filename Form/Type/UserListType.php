<?php

namespace San\UserBundle\Form\Type;

use Doctrine\Common\Persistence\ObjectManager;
use San\UserBundle\Form\DataTransformer\UsernameToUserTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserListType extends AbstractType
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new UsernameToUserTransformer($this->om));
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'textarea';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'san_user_list';
    }
}
