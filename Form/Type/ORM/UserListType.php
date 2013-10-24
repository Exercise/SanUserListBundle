<?php

namespace San\UserListBundle\Form\Type\ORM;

use Doctrine\ORM\EntityManager;
use San\UserListBundle\Form\DataTransformer\UsernameToUserTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserListType extends AbstractType
{
    /**
     * @var \Doctrine\Common\Persistence\EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $userClass;

    /**
     * @param EntityManager $em
     * @param string        $userClass
     */
    public function __construct(EntityManager $em, $userClass)
    {
        $this->em = $em;
        $this->userClass = $userClass;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new UsernameToUserTransformer($this->em, $this->userClass));
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
        return 'san_user_list_orm';
    }
}
