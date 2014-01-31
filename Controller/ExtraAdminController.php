<?php

namespace Picoss\SonataExtraAdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ExtraAdminController extends CRUDController
{
    /**
     * Move element
     *
     * @param integer $id
     * @param string $position
     */
    public function moveAction($id, $position)
    {
        $object = $this->admin->getObject($id);

        $sortableHandler = $this->get('picoss.sonataextraadmin.handler.sortable');
        $lastPosition = $sortableHandler->getLastPosition(get_class($object));
        $position = $sortableHandler->getPosition($object, $position, $lastPosition);

        $object->setPosition($position);
        $this->admin->update($object);

        if ($this->isXmlHttpRequest()) {
            return $this->renderJson(array(
                'result' => 'ok',
                'objectId' => $this->admin->getNormalizedIdentifier($object)
            ));
        }
        $this->addFlash('sonata_flash_info', $this->get('translator')->trans('flash_position_updated_successfully', array(), 'PicossSonataExtraAdminBundle'));

        return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
    }

    public function historyRevertAction($id, $revision)
    {
        $id     = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            // check the csrf token
            $this->validateCsrfToken('sonata.history.revert');

            try {
                $manager = $this->get('sonata.admin.audit.manager');

                if (!$manager->hasReader($this->admin->getClass())) {
                    throw new NotFoundHttpException(sprintf('unable to find the audit reader for class : %s', $this->admin->getClass()));
                }

                $reader = $manager->getReader($this->admin->getClass());
                $reader->revert($object, $revision);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'ok'));
                }

                $this->addFlash('sonata_flash_info', $this->get('translator')->trans('flash_history_revert_successfull', array(), 'PicossSonataExtraAdminBundle'));

            } catch (ModelManagerException $e) {

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'error'));
                }

                $this->addFlash('sonata_flash_info', $this->get('translator')->trans('flash_history_revert_error', array(), 'PicossSonataExtraAdminBundle'));
            }

            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        return $this->render($this->admin->getTemplate('history_revert'), array(
            'object'     => $object,
            'revision'   => $revision,
            'action'     => 'revert',
            'csrf_token' => $this->getCsrfToken('sonata.history.revert')
        ));
    }

    /**
     * return the Response object associated to the trash action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return Response
     */
    public function trashAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');
        $em->getFilters()->enable('softdeleteabletrash');

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getTemplate('trash'), array(
            'action'     => 'trash',
            'form'       => $formView,
            'datagrid'   => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ));
    }

    public function untrashAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable');
        $em->getFilters()->enable('softdeleteabletrash');

        $id     = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            // check the csrf token
            $this->validateCsrfToken('sonata.untrash');

            try {
                $object->setDeletedAt(null);
                $this->admin->update($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'ok'));
                }

                $this->addFlash('sonata_flash_info', $this->get('translator')->trans('flash_untrash_successfull', array(), 'PicossSonataExtraAdminBundle'));

            } catch (ModelManagerException $e) {

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'error'));
                }

                $this->addFlash('sonata_flash_info', $this->get('translator')->trans('flash_untrash_error', array(), 'PicossSonataExtraAdminBundle'));
            }

            return new RedirectResponse($this->admin->generateUrl('list'));
        }

        return $this->render($this->admin->getTemplate('untrash'), array(
            'object'     => $object,
            'action'     => 'untrash',
            'csrf_token' => $this->getCsrfToken('sonata.untrash')
        ));
    }

}
