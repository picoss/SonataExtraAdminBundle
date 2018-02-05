<?php

/*
 * This file is part of the YesWeHack BugBounty backend
 *
 * (c) Romain Honel <romain.honel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picoss\SonataExtraAdminBundle\Handler;

use Doctrine\ORM\EntityManager;

/**
 * Class SortableHandler
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class SortableHandler
{
    /**
     * Position constants
     */
    const MOVE_TOP = 'top';
    const MOVE_UP = 'up';
    const MOVE_DOWN = 'down';
    const MOVE_BOTTOM = 'bottom';

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * SortableHandler constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Get new position
     *
     * @param mixed $object
     * @param int   $position
     * @param int   $lastPosition
     *
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
     * @param mixed $object
     *
     * @return int
     */
    public function getLastPosition($object)
    {
        $repository = $this->em->getRepository(get_class($object));

        return $repository->getMaxPosition($object);
    }
}