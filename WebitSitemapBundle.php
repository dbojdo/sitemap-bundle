<?php

namespace Webit\Bundle\SitemapBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Webit\Bundle\SitemapBundle\DependencyInjection\Compiler\UrlExposerPass;

class WebitSitemapBundle extends Bundle
{
    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new UrlExposerPass());
    }
}
