<?php

/*
 * This file is part of the YesWeHack BugBounty backend
 *
 * (c) Romain Honel <romain.honel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picoss\SonataExtraAdminBundle\Model;

/**
 * Interface TrashManagerInterface
 *
 * @author Picoss <romain.honel@gmail.com>
 */
interface TrashManagerInterface
{
    /**
     * Set TrashReaderInterface service id for array of $classes.
     *
     * @param string $serviceId
     * @param array  $classes
     */
    public function setReader($serviceId, array $classes);

    /**
     * Returns true if $class has TrashReaderInterface.
     *
     * @param string $class
     *
     * @return bool
     */
    public function hasReader($class);

    /**
     * Get TrashReaderInterface service for $class.
     *
     * @param string $class
     *
     * @return \Picoss\SonataExtraAdminBundle\Model\TrashReaderInterface
     *
     * @throws \RuntimeException
     */
    public function getReader($class);
}
