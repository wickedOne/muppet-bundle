<?php

declare(strict_types=1);

/*
 * This file is part of the WickedOne MuppetBundle.
 * (c) wicliff <wicliff.wolda@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WickedOne\MuppetBundle\Tests\Unit\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionConfigurationTestCase;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use WickedOne\MuppetBundle\DependencyInjection\Configuration;
use WickedOne\MuppetBundle\DependencyInjection\WickedOneMuppetExtension;

/**
 * ConfigurationTest.
 *
 * @author wicliff <wicliff.wolda@gmail.com>
 */
class ConfigurationTest extends AbstractExtensionConfigurationTestCase
{
    /**
     * test empty configuration.
     */
    public function testEmptyConfiguration(): void
    {
        $expectedConfiguration = [
            'base_dir' => 'Foo/Bar',
            'test_dir' => 'Baz/Qux',
            'fragments' => [],
            'author' => null,
        ];

        $formats = array_map(
            static function ($path) {
                return __DIR__.'/../../Stub/'.$path;
            },
            [
                'config/empty.yaml',
                'config/empty.xml',
                'config/empty.php',
            ]
        );

        foreach ($formats as $format) {
            $this->assertProcessedConfigurationEquals($expectedConfiguration, [$format]);
        }
    }

    /**
     * test full configuration.
     */
    public function testFullConfiguration(): void
    {
        $expectedConfiguration = [
            'base_dir' => 'Foo/Bar',
            'test_dir' => 'Baz/Qux',
            'fragments' => [
                'Foo',
                'Bar',
                'Baz',
            ],
            'author' => 'foo <bar@baz.qux>',
        ];

        $formats = array_map(
            static function ($path) {
                return __DIR__.'/../../Stub/'.$path;
            },
            [
                'config/full.yaml',
                'config/full.xml',
                'config/full.php',
            ]
        );

        foreach ($formats as $format) {
            $this->assertProcessedConfigurationEquals($expectedConfiguration, [$format]);
        }
    }

    /**
     * @return \Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    protected function getContainerExtension(): ExtensionInterface
    {
        return new WickedOneMuppetExtension();
    }

    /**
     * @return \Symfony\Component\Config\Definition\ConfigurationInterface
     */
    protected function getConfiguration(): ConfigurationInterface
    {
        return new Configuration();
    }
}
