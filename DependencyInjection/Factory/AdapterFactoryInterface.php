<?php

namespace Chromedia\Bundle\MediaBundle\DependencyInjection\Factory;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Interface that must be implemented by the adapater factories
 */
interface AdapterFactoryInterface
{
    /**
     * Creates the adapter, registers it and returns its id
     *
     * @param  ContainerBuilder $container  A ContainerBuilder instance
     * @param  string           $id         The id of the service
     * @param  array            $config     An array of configuration
     */
    function create(ContainerBuilder $container, $id, array $config);

    /**
     * Returns the key for the factory configuration
     *
     * @return string
     */
    function getKey();

    /**
     * Adds configuration nodes for the factory
     *
     * @param  NodeBuilder $builder
     */
    function addConfiguration(NodeDefinition $builder);
}
