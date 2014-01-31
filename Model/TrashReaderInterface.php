<?php

namespace Picoss\SonataExtraAdminBundle\Model;

interface TrashReaderInterface
{

    public function restore($object);

//    /**
//     * @param string $className
//     * @param string $id
//     * @param string $revision
//     */
//    public function find($className, $id, $revision);
//
//    /**
//     * @param string $className
//     * @param int    $limit
//     * @param int    $offset
//     */
//    public function findRevisionHistory($className, $limit = 20, $offset = 0);
//
//    /**
//     * @param string $classname
//     * @param string $revision
//     */
//    public function findRevision($classname, $revision);
//
//    /**
//     * @param string $className
//     * @param string $id
//     */
//    public function findRevisions($className, $id);
}
