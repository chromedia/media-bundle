<?php

namespace Chromedia\Bundle\MediaBundle\DependencyInjection\Factory;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Service adapter factory
 */
class ServiceAdapterFactory implements AdapterFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $container->setAlias($id, $config['id']);
    }

    /**
     * {@inheritDoc}
     */
    public function getKey()
    {
        return 'service';
    }

    /**
     * {@inheritDoc}
     */
    public function addConfiguration(NodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode('id')->isRequired()->end()
            ->end()
        ;
    }
}
