<?php

namespace Picoss\SonataExtraAdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('picoss_sonata_extra_admin');

        $rootNode
            ->children()
                ->arrayNode('templates')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('history')->defaultValue('PicossSonataExtraAdminBundle:CRUD:history.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('history_revert')->defaultValue('PicossSonataExtraAdminBundle:CRUD:history_revert.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('history_revision_timestamp')->defaultValue('PicossSonataExtraAdminBundle:CRUD:history_revision_timestamp.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('trash')->defaultValue('PicossSonataExtraAdminBundle:CRUD:trash.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('untrash')->defaultValue('PicossSonataExtraAdminBundle:CRUD:untrash.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('inner_trash_list_row')->defaultValue('PicossSonataExtraAdminBundle:CRUD:list_trash_inner_row.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('list')->defaultValue('PicossSonataExtraAdminBundle:CRUD:base_list.html.twig')->cannotBeEmpty()->end()
                        ->arrayNode('types')
                            ->children()
                                ->arrayNode('list')
                                    ->useAttributeAsKey('name')
                                    ->prototype('scalar')->end()
                                ->end()
                                ->arrayNode('show')
                                    ->useAttributeAsKey('name')
                                    ->prototype('scalar')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
