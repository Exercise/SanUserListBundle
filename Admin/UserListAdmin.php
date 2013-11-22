<?php

namespace San\UserListBundle\Admin;

use San\UserListBundle\Admin\UserAdmin;
use San\UserListBundle\Form\Type\UserEntityType;
use San\UserListBundle\Model\UserList;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
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
}
