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
use Sonata\AdminBundle\Model\AuditReaderInterface;

/**
 * Class AuditReader
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class AuditReader implements AuditReaderInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var LoggableListener
     */
    private $loggable;

    /**
     * AuditReader constructor.
     *
     * @param EntityManager $em
     * @param LoggableListener $loggable
     */
    public function __construct(EntityManager $em, LoggableListener $loggable)
    {
        $this->em = $em;
        $this->loggable = $loggable;
    }

    /**
     * @param $className
     *
     * @return string
     */
    private function getObjectLogEntryClass($className)
    {
        $configuration = $this->loggable->getConfiguration($this->em, $className);

        return isset($configuration['logEntryClass'])?:'Gedmo\Loggable\Entity\LogEntry';
    }

    /**
     * @param string $className
     * @param string $id
     * @param string $revision
     *
     * @return mixed
     */
    public function find($className, $id, $revision)
    {

        $configuration = $this->loggable->getConfiguration($this->em, $className);

        $object = $this->em->find($className, $id);

        if ($configuration['loggable'] == true) {
            $repo = $this->em->getRepository($this->getObjectLogEntryClass($className));
            $repo->revert($object, $revision);
        }

        return clone $object;
    }

    /**
     * @param string $className
     * @param int    $limit
     * @param int    $offset
     */
    public function findRevisionHistory($className, $limit = 20, $offset = 0)
    {
        $repo = $this->em->getRepository($className);
    }

    /**
     * @param string $classname
     * @param string $revision
     *
     * @return [];
     */
    public function findRevision($classname, $revision)
    {
        return [];
    }

    /**
     * @param string $className
     * @param string $id
     *
     * @return mixed
     */
    public function findRevisions($className, $id)
    {
        $repo = $this->em->getRepository($this->getObjectLogEntryClass($className));

        $object = $this->em->find($className, $id);

        return $repo->getLogEntries($object);
    }

    /**
     * @param mixed $object
     * @param int   $revision
     */
    public function revert($object, $revision)
    {
        $repo = $this->em->getRepository($this->getObjectLogEntryClass(get_class($object)));
        $repo->revert($object, $revision);
        $this->em->persist($object);
        $this->em->flush();
    }

    /**
     * @param string $className
     * @param int $id
     * @param int $oldRevision
     * @param int $newRevision
     */
    public function diff($className, $id, $oldRevision, $newRevision)
    {
        // TODO: Implement diff() method.
    }

}