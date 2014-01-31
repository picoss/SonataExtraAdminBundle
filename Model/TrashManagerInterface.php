<?php

namespace Picoss\SonataExtraAdminBundle\Model;

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
