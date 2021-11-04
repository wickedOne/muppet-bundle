<?php

declare(strict_types=1);

/*
 * This file is part of the WickedOne MuppetBundle.
 * (c) wicliff <wicliff.wolda@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WickedOne\MuppetBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 *
 * @author wicliff <wicliff.wolda@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('wicked_one_muppet');
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        $this->addConfigSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $rootNode
     */
    private function addConfigSection(ArrayNodeDefinition $rootNode): void
    {
        $rootNode
            ->fixXmlConfig('fragment')
            ->children()
                ->scalarNode('base_dir')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('test_dir')->isRequired()->cannotBeEmpty()->end()
                ->arrayNode('fragments')
                    ->scalarPrototype()->end()
                ->end()
                ->scalarNode('author')->defaultNull()->end()
            ->end()
        ;
    }
}
