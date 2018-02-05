<?php

/*
 * This file is part of the YesWeHack BugBounty backend
 *
 * (c) Romain Honel <romain.honel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picoss\SonataExtraAdminBundle\Entity\Repository;

use Gedmo\Sortable\Entity\Repository\SortableRepository as BaseSortableRepository;

/**
 * Class SortableRepository
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class SortableRepository extends BaseSortableRepository
{
    /**
     * Get max position
     *
     * @param null $object
     *
     * @return mixed
     */
    public function getMaxPosition($object = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('MAX(n.' . $this->config['position'] . ')')
            ->from($this->config['useObjectClass'], 'n');

        if (isset($this->config['groups']) && count($this->config['groups']) > 0) {
            $i = 1;
            $qb->where('1 = 1');
            foreach ($this->config['groups'] as $group) {
                $value = $this->meta->getReflectionProperty($group)->getValue($object);
                if (is_null($value)) {
                    $qb->andWhere($qb->expr()->isNull('n.' . $group));
                } else {
                    $qb->andWhere('n.' . $group . ' = :group__' . $i);
                    $qb->setParameter('group__' . $i, $value);
                }
                $i++;
            }
        }

        $query = $qb->getQuery();
        $query->useQueryCache(false);
        $query->useResultCache(false);

        return $query->getSingleScalarResult();
    }
}