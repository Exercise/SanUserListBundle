<?php

namespace San\UserBundle\Controller\Admin;

use San\UserBundle\Entity\UserDynamicList;
use San\UserBundle\Form\Type\UserStaticListType;
use San\UserBundle\Form\Type\UserDynamicListType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserListCRUDController extends CRUDController
{
    /**
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userListEditAction(Request $request)
    {
        $listId = $request->query->get('id');
        if (!($list = $this->getDoctrine()->getRepository('SanUserBundle:UserList')->find($listId))) {
            throw new \InvalidArgumentException(sprintf('Static user list with id %u doesn\'t exist', $listId));
        }

        if ($list instanceof UserDynamicList) {
            $userAdmin = $this->get('san.admin.user');
            $datagrid = $userAdmin->getDatagrid();
            $filters = array();
            foreach ($list->getFilters() as $key => $value) {
                $datagrid->setalue($key, $value['type'], $value['value']);
            }
            $request->query->set('filter', $filters);
            $filterForm = $datagrid->getForm()->createView();

            return $this->showDynamicList($request, $list, $filterForm, 'edit');
        }

        $form = $this->createForm(new UserStaticListType(), $list);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
            }
        }

        return $this->render($this->admin->getTemplate('edit'), array(
            'action' => 'edit',
            'form'   => $form->createView(),
            'object' => $list,
        ));
    }

    /**
     * @param  Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createDynamicListAction(Request $request)
    {
        $userAdmin = $this->get('san.admin.user');
        $datagrid = $userAdmin->getDatagrid();
        $filters = $request->query->get('filter');
        foreach ($filters as $key => $value) {
            if (!is_array($value)) {
                continue;
            }
            $datagrid->setValue($key, $value['type'], $value['value']);
        }
        $filterForm = $datagrid->getForm()->createView();
        $activeFilters = array_filter($filters, function($filter){ return is_array($filter) && $filter['value']; });
        $userDynamicList = new UserDynamicList();
        $userDynamicList->setFilters($activeFilters);

        return $this->showDynamicList($request, $userDynamicList, $filterForm, 'create');
    }

    /**
     * @param  Request         $request
     * @param  UserDynamicList $dynamicList
     * @param  Form            $filterForm
     * @param  string          $action
     * @return \Symfony\Component\HttpFoundation\Redirect
     */
    protected function showDynamicList(Request $request, UserDynamicList $dynamicList, FormView $filterForm, $action)
    {
        $form = $this->createForm(new UserDynamicListType(), $dynamicList);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($dynamicList);
                $em->flush();
            }
        }

        return $this->render('SanUserBundle:Admin/CRUD:create_dynamic_list.html.twig', array(
            'action'     => $action,
            'form'       => $form->createView(),
            'filterForm' => $filterForm,
            'object'     => $dynamicList,
        ));
    }
}
