<?php

namespace Picoss\SonataExtraAdminBundle;

use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\AddAuditEntityCompilerPass;
use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\AddTrashEntityCompilerPass;
use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\FormPass;
use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\SonataTemplatesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PicossSonataExtraAdminBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new SonataTemplatesPass());
        $container->addCompilerPass(new FormPass());
        $container->addCompilerPass(new AddAuditEntityCompilerPass());
        $container->addCompilerPass(new AddTrashEntityCompilerPass());
    }
}
