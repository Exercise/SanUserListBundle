<?php

namespace San\UserListBundle\Admin;

use San\UserListBundle\Admin\UserAdmin;
use San\UserListBundle\Form\Type\UserEntityType;
use San\UserListBundle\Model\UserList;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\Datagrid;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserListAdmin extends Admin
{
    /**
     * @var string
     */
    protected $manager;

    /**
     * @var \San\UserListBundle\Admin\UserAdmin
     */
    protected $userAdmin;

    /**
     * @param string $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param UserAdmin $userAdmin
     */
    public function setUserAdmin(UserAdmin $userAdmin)
    {
        $this->userAdmin = $userAdmin;
    }

    /**
     * @return \San\UserListBundle\Admin\UserAdmin
     */
    public function getUserAdmin()
    {
        return $this->userAdmin;
    }

    /**
     * {@inheritdoc}
     */
    public function toString($object)
    {
        if (!is_object($object)) {
            return '';
        }

        if (method_exists($object, '__toString') && null !== $object->__toString()) {
            return (string) $object;
        }

        return 'Add new queue';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description', 'textarea')
            ->add('rawFilters', 'hidden')
        ;
    }

    // Fields to be shown on create/edit forms
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('description', 'textarea')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('delete')
            ->remove('edit')
            ->remove('export')
        ;
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
            ->add('Actions', 'string', array('template' => 'SanUserListBundle:Admin:list_actions.html.twig'))
        ;
    }

    /**
     * @param  UserList $list
     * @return array
     */
    public function getUsers(UserList $list)
    {
        $filters = $list->getFilters();
        $datagrid = $this->userAdmin->getDatagrid();
        foreach ($filters as $key => $value) {
            $datagrid->setValue($key, $value['type'], $value['value']);
        }

        return $datagrid->getResults();
    }

    /**
     * @param  Datagrid $datagrid
     * @return array
     */
    public function getDefaultFilters(Datagrid $datagrid)
    {
        $form = $datagrid->getForm();
        $filterParts = array();
        if (!$datagrid->hasActiveFilters()) {
            $filterParts = array('filter' => array());
            foreach ($form as $field) {
                $filterParts['filter'][$field->getName()]['type'] = '';
                if (!in_array($field->getName(), array('_sort_by', '_sort_order', '_page', '_per_page')) && !is_array($field->getData()['value'])) {
                    $filterParts['filter'][$field->getName()]['value'] = '';
                }

                if (in_array($field->getName(), array('_sort_by', '_sort_order', '_page', '_per_page'))) {
                    $filterParts['filter'][$field->getName()] = $field->getData();
                }
            }
        }

        return $filterParts;
    }
}
