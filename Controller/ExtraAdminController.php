<?php

namespace Picoss\SonataExtraAdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

}
