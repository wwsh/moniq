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

namespace spec\AppBundle\Browser;

use AppBundle\Analyzer\Directory;
use AppBundle\Driver\OutputInterface;
use AppBundle\Process\EntryProcessor;
use ArrayObject;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Argument\Token\StringContainsToken;
use WW\Vfs\Iterator\Disk;

class DirectoryBrowserSpec extends ObjectBehavior
{
    function it_is_initializable(OutputInterface $output, Disk $disk)
    {
        $this->beConstructedWith($output, $disk);
        $this->shouldHaveType('AppBundle\Browser\DirectoryBrowser');
    }

    function it_returns_tree_array_structure_for_found_directories(
        OutputInterface $output,
        Disk $fakeIterator,
        Disk $fakeDirectory,
        Disk $fakeFileIterator,
        Disk $fakeFileIterator2,
        Disk $fakeFile, // actually a string, but it doesn't matter in this test
        EntryProcessor $processor,
        ArrayObject $directoryParts,
        ArrayObject $filePartsArray
    ) {
        $fakeFile->getFilename()->shouldBeCalled()->willReturn('Pet Shop Boys from 1990', 'Spice Girls from 1995');

        $fakeFileIterator->valid()->shouldBeCalled()->willReturn(true, false, false);
        $fakeFileIterator->current()->shouldBeCalled()->willReturn($fakeFile);
        $fakeFileIterator->next()->shouldBeCalled();

        $fakeFileIterator2->valid()->shouldBeCalled()->willReturn(true, false, false);
        $fakeFileIterator2->current()->shouldBeCalled()->willReturn($fakeFile);
        $fakeFileIterator2->next()->shouldBeCalled();

        $fakeDirectory->isFile()->shouldBeCalled()
                      ->willReturn(false, false, false);

        $fakeDirectory->getFilename()->shouldBeCalled()
                      ->willReturn('1990 - 1994', '1995 - 1999');

        $fakeIterator->rewind()->shouldBeCalled();
        $fakeIterator->getPath()->shouldBeCalled()->willReturn('/some/path/MyMusic');
        $fakeIterator->valid()->shouldBeCalled()->willReturn(true, true, false);
        $fakeIterator->current()->shouldBeCalled()->willReturn($fakeDirectory, $fakeDirectory);
        $fakeIterator->getChildren()->shouldBeCalled()
                     ->willReturn($fakeFileIterator, $fakeFileIterator2);
        $fakeIterator->next()->shouldBeCalled();

        $processor->process('1990 - 1994')->shouldBeCalled()->willReturn($directoryParts);
        $processor->treatAs(Directory::RELEASE)->shouldBeCalled()->willReturn($processor);
        $processor->process('Pet Shop Boys from 1990')->shouldBeCalled()->willReturn($filePartsArray);
        $processor->process('1995 - 1999')->shouldBeCalled()->willReturn($directoryParts);
        $processor->treatAs(Directory::RELEASE)->shouldBeCalled()->willReturn($processor);
        $processor->process('Spice Girls from 1995')->shouldBeCalled()->willReturn($filePartsArray);

        $expectedOutput = [
            'Browsing path /some/path/MyMusic',
            'Processing directory 1990 - 1994',
            'Processing directory 1995 - 1999',
        ];

        $this->expectToOutput($output, $expectedOutput);

        $this->beConstructedWith($fakeIterator, $processor);
        $this->setOutput($output);
        $this->run();
    }

    function it_should_skip_problematic_files_in_releases(
        OutputInterface $output,
        Disk $fakeDirIterator,
        Disk $fakeDirectory,
        Disk $fakeFileIterator,
        Disk $fakeFile,
        EntryProcessor $processor,
        ArrayObject $directoryParts,
        ArrayObject $filePartsArray
    ) {

        $fakeFile->getFilename()->shouldBeCalled()->willReturn('cover.jpg');

        $fakeFileIterator->valid()->shouldBeCalled()->willReturn(true, false);
        $fakeFileIterator->current()->shouldBeCalled()->willReturn($fakeFile);
        $fakeFileIterator->next()->shouldBeCalled();


        $fakeDirectory->isFile()->shouldBeCalled()
                      ->willReturn(false, false);

        $fakeDirectory->getFilename()->shouldBeCalled()
                      ->willReturn('1986 Peter Gabriel - So');

        $fakeDirIterator->rewind()->shouldBeCalled();
        $fakeDirIterator->getPath()->shouldBeCalled()->willReturn('/some/path/hardMusic');
        $fakeDirIterator->valid()->shouldBeCalled()->willReturn(true, false);
        $fakeDirIterator->current()->shouldBeCalled()->willReturn($fakeDirectory, $fakeDirectory);
        $fakeDirIterator->getChildren()->shouldBeCalled()
                        ->willReturn($fakeFileIterator);
        $fakeDirIterator->next()->shouldBeCalled();

        $processor->process('1986 Peter Gabriel - So')->shouldBeCalled()->willReturn($directoryParts);
        $processor->treatAs(Directory::RELEASE)->shouldBeCalled()->willReturn($processor);
        $processor->process('cover.jpg')->shouldBeCalled()->willThrow(new \Exception('Incorrect file extension'));

        $expectedOutput = [
            'Browsing path /some/path/hardMusic',
            'Processing directory 1986 Peter Gabriel - So',
            'Skipped cover.jpg (Incorrect file extension)'
        ];

        $this->expectToOutput($output, $expectedOutput);

        $this->beConstructedWith($fakeDirIterator, $processor);
        $this->setOutput($output);
        $this->run();
    }

    /**
     * @param OutputInterface $output
     * @param $expectedOutput
     */
    private function expectToOutput(OutputInterface $output, $expectedOutput)
    {
        foreach ($expectedOutput as $expectedLine) {
            if ($expectedLine === '*') {
                $output->out()->shouldBeCalled()->withArguments([Argument::any()]);
            } else {
                $argument = [new StringContainsToken($expectedLine)];
                $output->out()->shouldBeCalled()->withArguments($argument);
            }
        }
    }
}
