<?php

namespace San\UserBundle\Controller\Admin;

use San\UserBundle\Form\Type\UserStaticListType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserCRUDController extends CRUDController
{
    /**
     * {@inheritDoc}
     */
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render('SanUserBundle:Admin/CRUD:user_list.html.twig', array(
            'action'        => 'list',
            'form'          => $formView,
            'userListAdmin' => $this->get('san.admin.user_list'),
            'datagrid'      => $datagrid,
            'csrf_token'    => $this->getCsrfToken('sonata.batch'),
        ));
    }
}
