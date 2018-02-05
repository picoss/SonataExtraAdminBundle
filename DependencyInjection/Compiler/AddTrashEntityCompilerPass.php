<?php

/*
 * This file is part of the YesWeHack BugBounty backend
 *
 * (c) Romain Honel <romain.honel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AddTrashEntityCompilerPass
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class AddTrashEntityCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $trashedEntities = array();
        foreach ($container->findTaggedServiceIds('sonata.admin') as $id => $attributes) {

            if ($attributes[0]['manager_type'] != 'orm') {
                continue;
            }

            if (!isset($attributes[0]['trash']) || $attributes[0]['trash'] == false) {
                continue;
            }

            $definition = $container->getDefinition($id);
            $definition->addMethodCall('setRouteBuilder', array(new Reference('picoss.sonataextraadmin.route.entity')));
            $trashedEntities[] = $this->getModelName($container, $definition->getArgument(1));
        }

        $trashedEntities = array_unique($trashedEntities);

        $container->getDefinition('picoss.sonataextraadmin.trash.manager')->addMethodCall('setReader', array('picoss.sonata.extra.admin.trash.orm.reader', $trashedEntities));
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @param string $name
     *
     * @return string
     */
    private function getModelName(ContainerBuilder $container, $name)
    {
        if ($name[0] == '%') {
            return $container->getParameter(substr($name, 1, -1));
        }

        return $name;
    }
}
