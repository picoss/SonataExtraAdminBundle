<?php

namespace Picoss\SonataExtraAdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class PicossSonataExtraAdminExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configs = $this->fixTemplatesConfiguration($configs);

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('picoss_sonata_extra_admin.templates', $config['templates']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    protected function fixTemplatesConfiguration(array $configs)
    {
        $defaultConfig = array(
            'templates' => array(
                'types' => array(
                    'list' => array(
                        'image'         => 'PicossSonataExtraAdminBundle:CRUD:list_image.html.twig',
                        'html_template' => 'PicossSonataExtraAdminBundle:CRUD:list_html_template.html.twig',
                        'progress_bar'  => 'PicossSonataExtraAdminBundle:CRUD:list_progress_bar.html.twig',
                        'label'         => 'PicossSonataExtraAdminBundle:CRUD:list_label.html.twig',
                        'badge'         => 'PicossSonataExtraAdminBundle:CRUD:list_badge.html.twig',
                    ),
                    'show' => array(
                        'image'         => 'PicossSonataExtraAdminBundle:CRUD:show_image.html.twig',
                        'html_template' => 'PicossSonataExtraAdminBundle:CRUD:show_html_template.html.twig',
                        'progress_bar'  => 'PicossSonataExtraAdminBundle:CRUD:show_progress_bar.html.twig',
                        'label'         => 'PicossSonataExtraAdminBundle:CRUD:show_label.html.twig',
                        'badge'         => 'PicossSonataExtraAdminBundle:CRUD:show_badge.html.twig',
                    )
                )
            )
        );

        array_unshift($configs, $defaultConfig);

        return $configs;
    }
}
