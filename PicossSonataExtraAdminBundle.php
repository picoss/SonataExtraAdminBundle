<?php

/*
 * This file is part of the YesWeHack BugBounty backend
 *
 * (c) Romain Honel <romain.honel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picoss\SonataExtraAdminBundle;

use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\AddAuditEntityCompilerPass;
use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\AddTrashEntityCompilerPass;
use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\EntityRouterCompilerPass;
use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\FormPass;
use Picoss\SonataExtraAdminBundle\DependencyInjection\Compiler\SonataTemplatesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class PicossSonataExtraAdminBundle
 *
 * @author Romain Honel <romain.honel@gmail.com>
 */
class PicossSonataExtraAdminBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SonataTemplatesPass());
        $container->addCompilerPass(new AddAuditEntityCompilerPass());
        $container->addCompilerPass(new AddTrashEntityCompilerPass());
        $container->addCompilerPass(new EntityRouterCompilerPass());
    }
}
