<?php

namespace Webit\Bundle\SitemapBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('webit_sitemap');
        $rootNode->children()
            ->scalarNode('target_dir')->defaultValue('%kernel.root_dir%/../web')->end()
            ->scalarNode('generation_interval')->defaultValue(1)->end()
        ->end();

        return $treeBuilder;
    }
}
