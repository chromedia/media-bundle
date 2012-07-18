<?php

namespace Chromedia\Bundle\MediaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Factory configuration for the Gaufrette DIC extension
 */
class FactoryConfiguration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder
            ->root('chromedia_gaufrette')
                ->ignoreExtraKeys()
                ->fixXmlConfig('factory', 'factories')
                ->children()
                    ->arrayNode('factories')
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
