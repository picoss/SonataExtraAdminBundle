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

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TrashManager
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class TrashManager implements TrashManagerInterface
{
    /**
     * @var array
     */
    protected $classes = [];

    /**
     * @var array
     */
    protected $readers = [];

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function setReader($serviceId, array $classes)
    {
        $this->readers[$serviceId] = $classes;
    }

    /**
     * {@inheritdoc}
     */
    public function hasReader($class)
    {
        foreach ($this->readers as $classes) {
            if (in_array($class, $classes)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getReader($class)
    {
        foreach ($this->readers as $readerId => $classes) {
            if (in_array($class, $classes)) {
                return $this->container->get($readerId);
            }
        }

        throw new \RuntimeException(sprintf('The class "%s" does not have any reader manager', $class));
    }
}
