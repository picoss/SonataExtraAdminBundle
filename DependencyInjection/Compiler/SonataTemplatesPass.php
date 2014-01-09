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
        $templates = $container->getParameter('sonata_doctrine_orm_admin.templates');

        $templates['types']['list'] = array_merge($templates['types']['list'], array(
            'image'         => 'PicossSonataExtraAdminBundle:CRUD:list_image.html.twig',
            'html_template' => 'PicossSonataExtraAdminBundle:CRUD:list_html_template.html.twig',
        ));

        $templates['types']['show'] = array_merge($templates['types']['show'], array(
            'image'         => 'PicossSonataExtraAdminBundle:CRUD:show_image.html.twig',
            'html_template' => 'PicossSonataExtraAdminBundle:CRUD:show_html_template.html.twig',
        ));

        $container->setParameter('sonata_doctrine_orm_admin.templates', $templates);

        // define the templates
        $container->getDefinition('sonata.admin.builder.orm_list')
            ->replaceArgument(1, $templates['types']['list']);

        $container->getDefinition('sonata.admin.builder.orm_show')
            ->replaceArgument(1, $templates['types']['show']);
    }
}
