<?php

namespace Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SonataTemplatesPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $extraTemplates = $container->getParameter('picoss_sonata_extra_admin.templates');

        $doctrineTemplates = $container->getParameter('sonata_doctrine_orm_admin.templates');

        $templates = array_merge_recursive($extraTemplates, $doctrineTemplates);

        $container->setParameter('sonata_doctrine_orm_admin.templates', array_merge_recursive($extraTemplates, $doctrineTemplates));

        // define the templates
        $container->getDefinition('sonata.admin.builder.orm_list')
            ->replaceArgument(1, $templates['types']['list']);

        $container->getDefinition('sonata.admin.builder.orm_show')
            ->replaceArgument(1, $templates['types']['show']);

        foreach ($container->findTaggedServiceIds('sonata.admin') as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition = $container->getDefinition($id);
                $definition->addMethodCall('setTemplate', array('history_revert', $extraTemplates['history_revert']));
                $definition->addMethodCall('setTemplate', array('trash', $extraTemplates['trash']));
                $definition->addMethodCall('setTemplate', array('untrash', $extraTemplates['untrash']));
                $definition->addMethodCall('setTemplate', array('inner_trash_list_row', $extraTemplates['inner_trash_list_row']));
                $definition->addMethodCall('setTemplate', array('list', $extraTemplates['list']));
            }
        }
    }
}
