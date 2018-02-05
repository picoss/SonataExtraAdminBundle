<?php

/*
 * This file is part of the YesWeHack BugBounty backend
 *
 * (c) Romain Honel <romain.honel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picoss\SonataExtraAdminBundle\DependencyInjection;

use Picoss\SonataExtraAdminBundle\Controller\ExtraAdminController;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class PicossSonataExtraAdminExtension
 *
 * @author Romain Honel <romain.honel@gmail.com>
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

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $bundles = $container->getParameter('kernel.bundles');
        if (isset($bundles['SonataDoctrineORMAdminBundle'])) {
            $loader->load('ORM/sortable.xml');

            if ($container->hasDefinition('stof_doctrine_extensions.listener.loggable')) {
                $loader->load('ORM/audit.xml');
            }

            if ($container->hasDefinition('stof_doctrine_extensions.listener.softdeleteable')) {
                $loader->load('ORM/trash.xml');
            }
        }

        $container->registerForAutoconfiguration(ExtraAdminController::class)
            ->addTag('controller.service_arguments');
    }

    protected function fixTemplatesConfiguration(array $configs)
    {
        $defaultConfig = array(
            'templates' => array(
                'types' => array(
                    'list' => array(
                        'image' => '@PicossSonataExtraAdmin/CRUD/list_image.html.twig',
                        'string_template' => '@PicossSonataExtraAdmin/CRUD/list_string_template.html.twig',
                        'progress_bar' => '@PicossSonataExtraAdmin/CRUD/list_progress_bar.html.twig',
                        'label' => '@PicossSonataExtraAdmin/CRUD/list_label.html.twig',
                        'badge' => '@PicossSonataExtraAdmin/CRUD/list_badge.html.twig',
                    ),
                    'show' => array(
                        'image' => '@PicossSonataExtraAdmin/CRUD/show_image.html.twig',
                        'string_template' => '@PicossSonataExtraAdmin/CRUD/show_string_template.html.twig',
                        'progress_bar' => '@PicossSonataExtraAdmin/CRUD/show_progress_bar.html.twig',
                        'label' => '@PicossSonataExtraAdmin/CRUD/show_label.html.twig',
                        'badge' => '@PicossSonataExtraAdmin/CRUD/show_badge.html.twig',
                    )
                )
            )
        );

        array_unshift($configs, $defaultConfig);

        return $configs;
    }
}
