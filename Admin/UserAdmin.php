<?php

namespace San\UserListBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
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
            ->add('username')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplate($name)
    {
        if ($name == 'list') {
            return 'SanUserBundle:Admin/CRUD:user_list.html.twig';
        }

        return parent::getTemplate($name);
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $dateType = 'san_orm_date';
        if ($this->manager != 'orm') {
            $dateType = 'san_mongodb_date';
        }

        $datagridMapper
            ->add('lastLogin', $dateType)
            ->add('registered', $dateType)
            ->add('username')
            ->add('enabled')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username')
            ->add('firstName')
            ->add('lastName')
            ->add('cell')
        ;
    }
}
