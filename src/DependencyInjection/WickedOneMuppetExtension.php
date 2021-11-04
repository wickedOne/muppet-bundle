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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use WickedOne\Muppet\Config\Config;
use WickedOne\Muppet\Generator;

/**
 * WickedOne Muppet Bundle Extension.
 *
 * @author wicliff <wicliff.wolda@gmail.com>
 */
class WickedOneMuppetExtension extends Extension
{
    /**
     * @param array<string, string|string[]>                          $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        if (null === $configuration = $this->getConfiguration($configs, $container)) {
            // @codeCoverageIgnoreStart
            return;
            // @codeCoverageIgnoreEnd
        }

        $config = $this->processConfiguration($configuration, $configs);

        $xmlLoader = new XmlFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));
        $xmlLoader->load('services.xml');

        $this->loadMuppetConfig($container, $config);
        $this->loadMuppetGenerator($container);
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @param array<string, string|string[]>                          $config
     */
    private function loadMuppetConfig(ContainerBuilder $container, array $config): void
    {
        $definition = new Definition(Config::class, [
            $config,
        ]);

        $container->setDefinition(Config::class, $definition);
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function loadMuppetGenerator(ContainerBuilder $container): void
    {
        $container
            ->getDefinition(Generator::class)
            ->replaceArgument(0, new Reference(Config::class))
        ;
    }
}
