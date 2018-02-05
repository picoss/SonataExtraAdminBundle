<?php

/*
 * This file is part of the YesWeHack BugBounty backend
 *
 * (c) Romain Honel <romain.honel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picoss\SonataExtraAdminBundle\Route;

use Picoss\SonataExtraAdminBundle\Model\TrashManagerInterface;
use Sonata\AdminBundle\Model\AuditManagerInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Route\PathInfoBuilder;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class EntityRouterBuilder
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class EntityRouterBuilder extends PathInfoBuilder implements RouteBuilderInterface
{
    /**
     * @var AuditManagerInterface
     */
    protected $manager;

    /**
     * @var TrashManagerInterface
     */
    protected $trashManager;

    public function __construct(AuditManagerInterface $manager, TrashManagerInterface $trashManager)
    {
        parent::__construct($manager);

        $this->trashManager = $trashManager;
    }

//    /**
//     * Set audit manager
//     *
//     * @param AuditManagerInterface $manager
//     */
//    public function setAuditManager(AuditManagerInterface $manager)
//    {
//        $this->manager = $manager;
//    }
//
//    /**
//     * Set trash manager
//     *
//     * @param TrashManagerInterface $trashManager
//     */
//    public function setTrashManager(TrashManagerInterface $trashManager)
//    {
//        $this->trashManager = $trashManager;
//    }

    /**
     * @param AdminInterface $admin
     * @param RouteCollection $collection
     */
    public function build(AdminInterface $admin, RouteCollection $collection)
    {
        parent::build($admin, $collection);

        if ($this->manager && $this->manager->hasReader($admin->getClass())) {
            $collection->add('history_revert', $admin->getRouterIdParameter() . '/history/{revision}/revert');
        }

        if ($this->trashManager && $this->trashManager->hasReader($admin->getClass())) {
            $collection->add('trash', 'trash');
            $collection->add('untrash', $admin->getRouterIdParameter() . '/untrash');
        }
    }
}