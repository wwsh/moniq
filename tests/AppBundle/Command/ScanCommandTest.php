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

namespace AppBundle\Tests\Command;

use AppBundle\Command\ScanCommand;
use Mockery;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class ScanCommandTest
 * @package AppBundle\Tests\Command
 */
class ScanCommandTest extends KernelTestCase
{

    public function testScanCommand()
    {
        $command = new ScanCommand();

        $kernel = $this->createKernel();
        $kernel->boot();

        // mock the driver service
        $nullDriver = Mockery::mock('AppBundle\Storage\StorageInterface');
        $nullDriver->shouldReceive('save');

        $kernel->getContainer()->set('app.storage_driver.mongo', $nullDriver);

        $command->setApplication(new Application($kernel));

        $tester = new CommandTester($command);
        $tester->execute(array(
            'command' => $command->getName(),
            'path' => '/music',
            '--filesystem' => 'vfs',
            '--definition' => __DIR__ . '/../../../src/AppBundle/Resources/vfs/example.json'
        ));

        $this->assertRegexp('/Processing directory 1993 Haddaway - What Is Love \(Remixes\)/', $tester->getDisplay());
        $this->assertRegexp('/1985 Paul Hardcastle - 19 \(The Final Story\) \[601 814\]/', $tester->getDisplay());
    }
}