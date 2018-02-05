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
 * Class AddAuditEntityCompilerPass
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class AddAuditEntityCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('doctrine.orm.entity_manager')) {
            return;
        }

        $auditedEntities = array();
        foreach ($container->findTaggedServiceIds('sonata.admin') as $id => $attributes) {

            if ($attributes[0]['manager_type'] != 'orm') {
                continue;
            }

            if (!isset($attributes[0]['audit']) || $attributes[0]['audit'] == false) {
                continue;
            }

            $definition = $container->getDefinition($id);
            $auditedEntities[] = $this->getModelName($container, $definition->getArgument(1));
        }

        $auditedEntities = array_unique($auditedEntities);

        $container->getDefinition('sonata.admin.audit.manager')->addMethodCall('setReader', array('picoss.sonata.extra.admin.audit.orm.reader', $auditedEntities));
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
