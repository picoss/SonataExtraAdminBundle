<?php

namespace Picoss\SonataExtraAdminBundle\Model;

use Doctrine\ORM\EntityManager;
use Gedmo\Loggable\LoggableListener;
use Sonata\AdminBundle\Model\AuditReaderInterface;

class AuditReader implements AuditReaderInterface
{

    private $em;

    private $loggable;

    public function __construct(EntityManager $em, LoggableListener $loggable)
    {
        $this->em = $em;
        $this->loggable = $loggable;
    }

    /**
     * @param $className
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
     */
    public function findRevision($classname, $revision)
    {
        return array();
    }

    /**
     * @param string $className
     * @param string $id
     */
    public function findRevisions($className, $id)
    {
        $repo = $this->em->getRepository($this->getObjectLogEntryClass($className));

        $object = $this->em->find($className, $id);

        return $repo->getLogEntries($object);
    }

    public function revert($object, $revision)
    {
        $repo = $this->em->getRepository($this->getObjectLogEntryClass(get_class($object)));
        $repo->revert($object, $revision);
        $this->em->persist($object);
        $this->em->flush();
    }

    public function diff($className, $id, $oldRevision, $newRevision)
    {
        // TODO: Implement diff() method.
    }

}