<?php

namespace San\UserListBundle\Controller\Admin;

use San\UserListBundle\Entity\UserDynamicList;
use San\UserListBundle\Form\Type\UserStaticListType;
use San\UserListBundle\Form\Type\UserDynamicListType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserDynamicListCRUDController extends CRUDController
{
    /**
     * return the Response object associated to the create action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function createAction()
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();
        $this->admin->setSubject($object);

        if ($this->getRestMethod() == 'GET') {
            $rawFilters = $this->get('request')->query->get('filter');
            $filters = $this->getFilters($rawFilters);
            $object->setRawFilters(json_encode($filters));
            $object->setFilters($filters);
        }

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            $form->bind($this->get('request'));
            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                $filters = $this->getFilters(json_decode($object->getRawFilters(), true));
                $object->setFilters($filters);
                $this->admin->create($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                        'result' => 'ok',
                        'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->addFlash('sonata_flash_success','flash_create_success');
                // redirect to edit mode
                return $this->redirectTo($object);
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', 'flash_create_error');
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
        ));
    }

    /**
     * @param  array $rawFilters
     * @return array
     */
    protected function getFilters(array $rawFilters)
    {
        $filters = array();
        foreach ($rawFilters as $key => $value) {
            if (!is_array($value) || !$value['value']) {
                continue;
            }

            $filters[$key] = $value;
        }

        return $filters;
    }
}