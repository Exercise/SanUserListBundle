<?php

namespace San\UserListBundle\Admin;

use San\UserListBundle\Form\Type\UserEntityType;
use San\UserListBundle\Model\UserList;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserDynamicListAdmin extends Admin
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

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description', 'textarea')
            ->add('rawFilters', 'hidden')
            ->add('filters', 'collection', array(
                'type'      => 'san_list_filter',
                'read_only' => true,
                'allow_add' => true
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate($name)
    {
        if ($name == 'edit') {
            return 'SanUserListBundle:Admin/CRUD:edit_user_dynamic_list.html.twig';
        }

        return parent::getTemplate($name);
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('description')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit'   => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
}
