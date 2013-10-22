<?php

namespace San\UserBundle\Controller\Admin;

use San\UserBundle\Form\Type\UserStaticListType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class UserListCRUDController extends CRUDController
{
    public function userListEditAction(Request $request)
    {
        $listId = $request->query->get('id');
        if (!($list = $this->getDoctrine()->getRepository('SanUserBundle:UserList')->find($listId))) {
            throw new \InvalidArgumentException(sprintf('Static user list with id %u doesn\'t exist', $listId));
        }

        $form = $this->createForm(new UserStaticListType(), $list);
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render($this->admin->getTemplate('edit'), array(
            'action' => 'edit',
            'form'   => $form->createView(),
            'object' => $list,
        ));
    }
}
