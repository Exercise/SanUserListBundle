<?php

namespace San\UserBundle\Admin;

use San\UserBundle\Form\Type\UserEntityType;
use San\UserBundle\Model\UserList;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserListAdmin extends Admin
{
    /**
     * @var string
     */
    protected $manager;

    /**
     * @param string $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function generateObjectUrl($name, $object, array $parameters = array(), $absolute = false)
    {
        if ($name == 'edit') {
            return $this->generateObjectUrl('userListEdit', $object, $parameters, $absolute);
        }

        return parent::generateObjectUrl($name, $object, $parameters, $absolute);
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('userListEdit');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('description')
            ->add('type')
            ->add('usersNumber', 'number')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit'   => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
}
