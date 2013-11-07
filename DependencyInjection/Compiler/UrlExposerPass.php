<?php
namespace Webit\Bundle\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Definition;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class UrlExposerPass implements CompilerPassInterface {
    public function process(ContainerBuilder $container) {
        $this->registerStores($container);
    }
    
    private function registerStores(ContainerBuilder $container) {
        $chain = $container->getDefinition('webit_sitemap.exposer.chain');
        $arIds = $container->findTaggedServiceIds('webit_sitemap.url_exposer');
        foreach($arIds as $id=>$tag) {
            $chain->addMethodCall('registerExposer',array($container->getDefinition($id)));
        }
    }
}