<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2016 WW Software House
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace MoniqBundle\Command;

use MoniqBundle\Factory\ScannerFactory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class ScanCommand
 * @package MoniqBundle\Command
 */
class ScanCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('moniq:scan')
            ->setDescription('Performs a disk scan for multimedia sound files. 
See docs for explanation of supported standards.')
            ->setDefinition(array(
                                new InputArgument('path', InputArgument::REQUIRED, 'The path to scan'),
                                new InputOption('filesystem', 'fs', InputOption::VALUE_OPTIONAL,
                                                'Filesystem type [disk|vfs]', 'disk'),
                                new InputOption('definition', 'd', InputOption::VALUE_OPTIONAL,
                                                'VFS definition .json file'),
                            ));
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $path       = $input->getArgument('path');
        $fs         = $input->getOption('filesystem');
        $definition = $input->getOption('definition');
        $driver     = $this->getContainer()->get('app.storage_driver.mongo');

        $output->writeln('<comment>Starting multimedia scanner...</comment>');

        $scanner = ScannerFactory::create($output, $fs, $definition, $path, $driver);
        return $scanner->run();
    }
}