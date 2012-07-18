<?php

namespace Chromedia\Bundle\MediaBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Compiler pass that registers the adapters
 */
class AdapterManagerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('chromedia_gaufrette.adapter_manager')) {
            return;
        }

        $definition = $container->getDefinition('chromedia_gaufrette.adapter_manager');
        $calls = $definition->getMethodCalls();
        $definition->setMethodCalls(array());

        foreach ($container->findTaggedServiceIds('gaufrette.adapter') as $id => $attributes) {
            if (!empty($attributes['alias'])) {
                $definition->addMethodCall('set', array($attributes['alias'], new Reference($id)));
            }
        }

        $definition->setMethodCalls(array_merge($definition->getMethodCalls(), $calls));
    }
}
