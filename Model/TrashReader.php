<?php

namespace Picoss\SonataExtraAdminBundle\Model;

use Doctrine\ORM\EntityManager;
use Gedmo\Loggable\LoggableListener;
use Gedmo\SoftDeleteable\SoftDeleteableListener;
use Sonata\AdminBundle\Model\AuditReaderInterface;

class TrashReader implements TrashReaderInterface
{

    private $em;

    private $softDeleteable;

    public function __construct(EntityManager $em, SoftDeleteableListener $softDeleteable)
    {
        $this->em = $em;
        $this->softDeleteable = $softDeleteable;
    }

    /**
     * @param string $className
     * @param string $id
     * @param string $revision
     */
    public function restore($object)
    {

    }

}