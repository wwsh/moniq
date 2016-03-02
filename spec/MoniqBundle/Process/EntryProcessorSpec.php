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

namespace spec\MoniqBundle\Process;

use MoniqBundle\Analyzer\Directory;
use MoniqBundle\Driver\ConsoleOutput;
use MoniqBundle\Exception\SamplerContainerDirectoryException;
use MoniqBundle\Parser\Release;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Argument\Token\StringContainsToken;
use Symfony\Component\Console\Output\OutputInterface;


class EntryProcessorSpec extends ObjectBehavior
{
    function it_is_initializable(ConsoleOutput $output)
    {
        $this->beConstructedWith($output);
        $this->shouldHaveType('MoniqBundle\Process\EntryProcessor');
    }

    function it_processes_entries(ConsoleOutput $output)
    {
        $this->expectToOutput($output, ['R:']);
        $this->beConstructedWith($output);
        $this->process('1991 EMF - Unbelievable');
    }

    function it_allows_enforcing_dataset_type(ConsoleOutput $output)
    {
        $this->expectToOutput($output, ['R:']);
        $this->beConstructedWith($output);
        $this->treatAs(Directory::RELEASE);
        $this->process('1 - Robert Miles - Children');
    }

    function it_should_forget_about_treat_in_next_process(ConsoleOutput $output)
    {
        $this->expectToOutput($output, ['R:']);
        $this->beConstructedWith($output);
        $this->treatAs(Directory::RELEASE);
        $this->process('Turtle Beach - Summer Nights');
        $this->getEnforcedType()->shouldBe(null);
    }

    function it_should_signal_unexpected_sampler_folders_with_exception(ConsoleOutput $output)
    {
        $this->beConstructedWith($output);
        $this->shouldThrow(new SamplerContainerDirectoryException())->during('process', ['CD1']);
    }


    /**
     * @param OutputInterface $output
     * @param $expectedOutput
     */
    protected function expectToOutput(OutputInterface $output, $expectedOutput)
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
