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

use Doctrine\ORM\EntityManager;
use Gedmo\Loggable\LoggableListener;
use Gedmo\SoftDeleteable\SoftDeleteableListener;
use Sonata\AdminBundle\Model\AuditReaderInterface;

/**
 * Class TrashReader
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class TrashReader implements TrashReaderInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var SoftDeleteableListener
     */
    private $softDeleteable;

    /**
     * TrashReader constructor.
     *
     * @param EntityManager $em
     * @param SoftDeleteableListener $softDeleteable
     */
    public function __construct(EntityManager $em, SoftDeleteableListener $softDeleteable)
    {
        $this->em = $em;
        $this->softDeleteable = $softDeleteable;
    }

    /**
     * @param mixed $object
     */
    public function restore($object)
    {
        $object->setDeletedAt(null);
        $this->em->persist($object);
        $this->em->flush();
    }
}