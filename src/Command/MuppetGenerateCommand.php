<?php

declare(strict_types=1);

/*
 * This file is part of the WickedOne MuppetBundle.
 * (c) wicliff <wicliff.wolda@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WickedOne\MuppetBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WickedOne\Muppet\Contract\GeneratorInterface;

/**
 * Muppet Generate Command.
 *
 * @author wicliff <wicliff.wolda@gmail.com>
 */
class MuppetGenerateCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'muppet:generate:test';

    /**
     * @var \WickedOne\Muppet\Contract\GeneratorInterface
     */
    private GeneratorInterface $generator;

    /**
     * @param \WickedOne\Muppet\Contract\GeneratorInterface $generator
     */
    public function __construct(GeneratorInterface $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setDescription('generate unit test for given model')
            ->setDefinition([
                new InputArgument('model', InputArgument::REQUIRED, 'model classname'),
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $this->generator->generate($input->getArgument('model'));

        $output->writeln(sprintf('<comment>></comment> <info>succesfully generated test class @ %s</info>', $file));

        return Command::SUCCESS;
    }
}
