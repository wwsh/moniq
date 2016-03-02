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

namespace MoniqBundle\Factory;

use MoniqBundle\Browser\DirectoryBrowser;
use MoniqBundle\Driver\ConsoleOutput;
use MoniqBundle\Driver\OutputInterface;
use MoniqBundle\Process\EntryProcessor;
use MoniqBundle\Service\Scanner;
use MoniqBundle\Storage\StorageInterface;
use WW\Vfs\Factory\FileSystemFactory;

/**
 * Class ScannerFactory
 * @package MoniqBundle\Factory
 */
class ScannerFactory
{
    /**
     * Scanner Factory.
     * Connecting all modules.
     *
     * @param $output Console output interface.
     * @param $fsType Filesystem type (disk, vfs)
     * @param $definition VFS definition file in .json (full path)
     * @param $path Path to scan
     * @param $driver Storage driver.
     * @return Scanner
     */
    public static function create($output, $fsType, $definition, $path, $driver)
    {
        $fileSystemIterator = FileSystemFactory::create($fsType, [$path, $definition]);
        $output             = new ConsoleOutput($output);
        $processor          = new EntryProcessor($output);
        $browser            = new DirectoryBrowser($fileSystemIterator, $processor);

        $browser->setOutput($output);

        $scanner = new Scanner($browser, $driver);
        return $scanner;
    }
}
