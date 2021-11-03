<?php

declare(strict_types=1);

/*
 * This file is part of the WickedOne MuppetBundle.
 * (c) wicliff <wicliff.wolda@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WickedOne\MuppetBundle\Tests\Unit\Command;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use WickedOne\Muppet\Contract\GeneratorInterface;
use WickedOne\MuppetBundle\Command\MuppetGenerateCommand;

/**
 * MuppetGenerateCommandTest.
 *
 * @author wicliff <wicliff.wolda@gmail.com>
 */
class MuppetGenerateCommandTest extends TestCase
{
    /**
     * test execute.
     */
    public function testExecute(): void
    {
        $application = new Application();

        $generator = $this->getMockBuilder(GeneratorInterface::class)->disableOriginalConstructor()->getMock();
        $generator->expects(self::once())->method('generate')->with('foo')->willReturn('foo.php');

        $application->add(new MuppetGenerateCommand($generator));

        $command = $application->find('muppet:generate:test');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'model' => 'foo',
        ]);

        self::assertSame(Command::SUCCESS, $commandTester->getStatusCode());
        self::assertSame('> succesfully generated test class @ foo.php', trim($commandTester->getDisplay()));
    }
}
