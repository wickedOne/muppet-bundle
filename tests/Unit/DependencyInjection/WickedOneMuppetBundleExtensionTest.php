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

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use WickedOne\Muppet\Config\Config;
use WickedOne\Muppet\Generator;
use WickedOne\Muppet\Method\ReadWriteTestMethod;
use WickedOne\Muppet\Method\ValueMethod;
use WickedOne\Muppet\Property\AccessorsProperty;
use WickedOne\Muppet\Property\ClassProperty;
use WickedOne\Muppet\Property\NonNullableProperty;
use WickedOne\Muppet\Property\ValuesProperty;
use WickedOne\MuppetBundle\Command\MuppetGenerateCommand;
use WickedOne\MuppetBundle\DependencyInjection\WickedOneMuppetBundleExtension;

/**
 * WickedOneMuppetBundleExtensionTest.
 *
 * @author wicliff <wicliff.wolda@gmail.com>
 */
class WickedOneMuppetBundleExtensionTest extends AbstractExtensionTestCase
{
    /**
     * test load services.
     */
    public function testLoadServices(): void
    {
        $this->load();
        $this->compile();

        $this->assertContainerBuilderHasService(ReadWriteTestMethod::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(ReadWriteTestMethod::class, 'muppet.method');

        $this->assertContainerBuilderHasService(ValueMethod::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(ValueMethod::class, 'muppet.method');

        $this->assertContainerBuilderHasService(AccessorsProperty::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(AccessorsProperty::class, 'muppet.property');

        $this->assertContainerBuilderHasService(ClassProperty::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(ClassProperty::class, 'muppet.property');

        $this->assertContainerBuilderHasService(NonNullableProperty::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(NonNullableProperty::class, 'muppet.property');

        $this->assertContainerBuilderHasService(ValuesProperty::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(ValuesProperty::class, 'muppet.property');

        $this->assertContainerBuilderHasService(MuppetGenerateCommand::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag(MuppetGenerateCommand::class, 'console.command');

        $this->assertContainerBuilderHasService(Generator::class);
        $this->assertContainerBuilderHasService(Config::class);

        $this->assertContainerBuilderHasServiceDefinitionWithArgument(Generator::class, 0, Config::class);
        $this->assertContainerBuilderHasServiceDefinitionWithArgument(Config::class, 0, 'foo/bar');
        $this->assertContainerBuilderHasServiceDefinitionWithArgument(Config::class, 1, 'baz/qux');
        $this->assertContainerBuilderHasServiceDefinitionWithArgument(Config::class, 2, []);
        $this->assertContainerBuilderHasServiceDefinitionWithArgument(Config::class, 3, null);
    }

    /**
     * @return \WickedOne\MuppetBundle\DependencyInjection\WickedOneMuppetBundleExtension[]
     */
    protected function getContainerExtensions(): array
    {
        return [new WickedOneMuppetBundleExtension()];
    }

    /**
     * @return string[]
     */
    protected function getMinimalConfiguration(): array
    {
        return [
            'base_dir' => 'foo/bar',
            'test_dir' => 'baz/qux',
        ];
    }
}
