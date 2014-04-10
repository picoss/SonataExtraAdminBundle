<?php

namespace Picoss\SonataExtraAdminBundle\Handler;

use Doctrine\ORM\EntityManager;

class SortableHandler
{

    /**
     * Position constants
     */
    const MOVE_TOP      = 'top';
    const MOVE_UP       = 'up';
    const MOVE_DOWN     = 'down';
    const MOVE_BOTTOM   = 'bottom';

    /**
     * Entity manager
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Get new position
     *
     * @param $object
     * @param $position
     * @param $lastPosition
     * @return int
     */
    public function getPosition($object, $position, $lastPosition)
    {
        switch ($position) {
            case self::MOVE_UP:
                if ($object->getPosition() > 0) {
                    $position = $object->getPosition() - 1;
                }
                break;

            case self::MOVE_DOWN:
                if ($object->getPosition() < $lastPosition) {
                    $position = $object->getPosition() + 1;
                }
                break;

            case self::MOVE_TOP:
                if ($object->getPosition() > 0) {
                    $position = 0;
                }
                break;

            case self::MOVE_BOTTOM:
                if ($object->getPosition() < $lastPosition) {
                    $position = $lastPosition;
                }
                break;
        }
        return is_numeric($position) ? $position : $object->getPosition();
    }

    /**
     * Get entity last position
     *
     * @param $entity
     * @return int
     */
    public function getLastPosition($object)
    {
        $repository = $this->em->getRepository(get_class($object));
        return $repository->getMaxPosition($object);

//        $query = $this->em->createQuery('SELECT MAX(e.position) FROM ' . $object . ' e');
//        return $query->getSingleScalarResult();
    }
}