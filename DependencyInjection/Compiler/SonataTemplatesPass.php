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
//        $templates = $container->getParameter('sonata_doctrine_orm_admin.templates');
//
//        $templates['types']['list'] = array_merge($templates['types']['list'], array(
//            'image' => 'PureExtraAdminBundle:CRUD:list_image.html.twig',
//            'html_template' => 'PureExtraAdminBundle:CRUD:list_html_template.html.twig',
//        ));
//
//        $templates['types']['show'] = array_merge($templates['types']['show'], array(
//            'image' => 'PureExtraAdminBundle:CRUD:show_image.html.twig',
//        ));
//
//        $container->setParameter('sonata_doctrine_orm_admin.templates', $templates);
//
//        // define the templates
//        $container->getDefinition('sonata.admin.builder.orm_list')
//            ->replaceArgument(1, $templates['types']['list']);
//
//        $container->getDefinition('sonata.admin.builder.orm_show')
//            ->replaceArgument(1, $templates['types']['show']);
    }
}
