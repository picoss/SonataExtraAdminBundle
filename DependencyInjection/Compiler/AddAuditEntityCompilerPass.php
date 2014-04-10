<?php

namespace Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class AddAuditEntityCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $auditedEntities = array();
        foreach ($container->findTaggedServiceIds('sonata.admin') as $id => $attributes) {

            if ($attributes[0]['manager_type'] != 'orm') {
                continue;
            }

            if (!isset($attributes[0]['audit']) || $attributes[0]['audit'] == false) {
                continue;
            }

            $definition = $container->getDefinition($id);
            $definition->addMethodCall('setRouteBuilder', array(new Reference('picoss.sonataextraadmin.route.entity')));
            $auditedEntities[] = $this->getModelName($container, $definition->getArgument(1));
        }

        $auditedEntities = array_unique($auditedEntities);

        $container->getDefinition('sonata.admin.audit.manager')->addMethodCall('setReader', array('picoss.sonata.extra.admin.audit.orm.reader', $auditedEntities));
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @param string                                                  $name
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
