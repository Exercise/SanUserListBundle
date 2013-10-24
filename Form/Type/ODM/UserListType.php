<?php

namespace San\UserListBundle\Form\Type\ODM;

use Doctrine\ODM\MongoDB\DocumentManager;
use San\UserListBundle\Form\DataTransformer\UsernameToUserTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserListType extends AbstractType
{
    /**
     * @var \Doctrine\Common\Persistence\DocumentManager
     */
    protected $dm;

    /**
     * @var string
     */
    protected $userClass;

    /**
     * @param DocumentManager $dm
     * @param string          $userClass
     */
    public function __construct(DocumentManager $dm, $userClass)
    {
        $this->dm = $dm;
        $this->userClass = $userClass;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new UsernameToUserTransformer($this->dm, $this->userClass));
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
        return 'san_user_list_odm';
    }
}
