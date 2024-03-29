<?php
namespace Chromedia\Bundle\MediaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration processer.
 * Parses/validates the extension configuration and sets default values.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('chromedia_media');

        $this->addCdnSection($rootNode);
        $this->addProviderSection($rootNode);
        $this->addGeneratorSection($rootNode);
        $this->addManipulatorSection($rootNode);
        $this->addFilesystemSection($rootNode);
        $this->addContextsSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Parses the chromedia_media.cdn config section
     * Example for yaml driver:
     * chromedia_media:
     *     cdn: chromedia_media.cdn.remote_server
     *
     * @param ArrayNodeDefinition $node
     * @return void
     */
    private function addCdnSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('cdn')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->beforeNormalization()
                            ->ifTrue(function($v) { return !is_array($v); })
                            ->thenInvalid('The chromedia_media.cdn config "%s" must be an array.')
                        ->end()
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('default')->defaultValue(false)->end()
                            ->scalarNode('id')->isRequired()->end()
                            ->arrayNode('options')
                                ->useAttributeAsKey('name')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->defaultValue(array(
                        'local' => array(
                            'default' => true,
                            'id' => 'chromedia_media.cdn.remote_server',
                            'options' => array(
                                'base_url' => '/media'
                            )
                        )
                    ))
                ->end()
            ->end();
    }

    /**
     * Parses the chromedia_media.provider config section
     * Example for yaml driver:
     * chromedia_media:
     *     provider:
     *         image:
     *             default: true #optional
     *             id: chromedia_media.provider.image
     *             filesystem: local #optional
     *             cdn: local #optional
     *
     * @param ArrayNodeDefinition $node
     * @return void
     */
    private function addProviderSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('provider')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->beforeNormalization()
                            ->ifTrue(function($v) { return !is_array($v); })
                            ->thenInvalid('The chromedia_media.provider config "%s" must be an array.')
                        ->end()
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('default')->defaultValue(false)->end()
                            ->scalarNode('id')->isRequired()->end()
                            ->scalarNode('filesystem')->end()
                            ->scalarNode('cdn')->end()
                            ->scalarNode('path_generator')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Parses the chromedia_media.generator config section
     * Example for yaml driver:
     * chromedia_media:
     *     generator:
     *         path:
     *             default:
     *                 default: true
     *                 id: chromedia_media.generator.path.default
     *         uuid:
     *             default:
     *                 default: true
     *                 id: chromedia_media.generator.uuid.default
     *
     * @param ArrayNodeDefinition $node
     * @return void
     */
    private function addGeneratorSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('generator')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('path')
                            ->useAttributeAsKey('name')
                            ->prototype('array')
                                ->beforeNormalization()
                                    ->ifTrue(function($v) { return !is_array($v); })
                                    ->thenInvalid('The chromedia_media.generator.path config "%s" must be an array.')
                                ->end()
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('default')->defaultValue(false)->end()
                                    ->scalarNode('id')->isRequired()->end()
                                ->end()
                            ->end()
                            ->defaultValue(array(
                                'default' => array(
                                    'default' => true,
                                    'id' => 'chromedia_media.generator.path.default',
                                )
                            ))
                        ->end()
                        ->arrayNode('uuid')
                            ->useAttributeAsKey('name')
                            ->prototype('array')
                                ->beforeNormalization()
                                    ->ifTrue(function($v) { return !is_array($v); })
                                    ->thenInvalid('The chromedia_media.generator.uuid config "%s" must be an array.')
                                ->end()
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('default')->defaultValue(false)->end()
                                    ->scalarNode('id')->isRequired()->end()
                                ->end()
                            ->end()
                            ->defaultValue(array(
                                'default' => array(
                                    'default' => true,
                                    'id' => 'chromedia_media.generator.uuid.default',
                                )
                            ))
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Parses the chromedia_media.manipulator config section
     * Example for yaml driver:
     * chromedia_media:
     *     manipulator:
     *         image:
     *             default: true
     *             id: chromedia_media.util.image.manipulator.imagine
     *
     * @param ArrayNodeDefinition $node
     * @return void
     */
    private function addManipulatorSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('manipulator')
                    //->addDefaultsIfNotSet()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->beforeNormalization()
                            ->ifTrue(function($v) { return !is_array($v); })
                            ->thenInvalid('The chromedia_media.manipulator config "%s" must be an array.')
                        ->end()
                        //->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('default')->defaultValue(false)->end()
                            ->scalarNode('id')->isRequired()->end()
                        ->end()
                    ->end()
                    ->defaultValue(array(
                        'imagine' => array(
                            'default' => true,
                            'id' => 'chromedia_media.util.image.manipulator.imagine',
                        )
                    ))
                ->end()
            ->end();
    }

    /**
     * Parses the chromedia_media.filesystem config section
     * Example for yaml driver:
     * chromedia_media:
     *     filesystem:
     *         local:
     *             default: true
     *             id: chromedia_media.filesystem.local
     *             options:
     *                 base_path: %kernel.root_dir%/../web/media
     *                 create: true
     *
     * @param ArrayNodeDefinition $node
     * @return void
     */
    private function addFilesystemSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('filesystem')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->beforeNormalization()
                            ->ifTrue(function($v) { return !is_array($v); })
                            ->thenInvalid('The chromedia_media.filesystem config "%s" must be an array.')
                        ->end()
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('default')->defaultValue(false)->end()
                            ->scalarNode('id')->isRequired()->end()
                            ->arrayNode('options')
                                ->useAttributeAsKey('name')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->defaultValue(array(
                        'local' => array(
                            'default' => true,
                            'id' => 'chromedia_media.filesystem.local',
                            'options' => array(
                                'base_path' => '%kernel.root_dir%/../web/media',
                                'create' => true
                            )
                        )
                    ))
                ->end()
            ->end();
    }

    /**
     * Parses the chromedia_media.contexts config section
     * Example for yaml driver:
     * chromedia_media:
     *     contexts:
     *         user_picture:
     *             provider: chromedia_media.provider.image
     *             generator:
     *                 path: chromedia_media.generator.path.default
     *                 uuid: chromedia_media.generator.uuid.default
     *             formats:
     *                 small: { width: 50, height: 50 }
     *                 medium: { width: 90, height: 90 }
     *                 large:  { width: 200, height: 200 }
     *
     * @param ArrayNodeDefinition $node
     * @return void
     */
    private function addContextsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('contexts')
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->beforeNormalization()
                            ->ifTrue(function($v) { return !is_array($v); })
                            ->thenInvalid('The chromedia_media.contexts config "%s" must be an array.')
                        ->end()
                        ->children()
                            ->scalarNode('provider')->end()
                            ->arrayNode('generator')
                                ->children()
                                    ->scalarNode('path')->end()
                                    ->scalarNode('uuid')->end()
                                ->end()
                            ->end()
                            ->arrayNode('formats')
                                ->useAttributeAsKey('name')
                                ->prototype('array')
                                    ->useAttributeAsKey('name')
                                    ->prototype('scalar')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}