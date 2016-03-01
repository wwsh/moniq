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

namespace spec\AppBundle\Process\Strategy;

use AppBundle\Analyzer\Directory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProcessStrategySpec extends ObjectBehavior
{
    function it_is_initializable($strategyContextSelector)
    {
        $this->beConstructedWith($strategyContextSelector);
        $this->shouldHaveType('AppBundle\Process\Strategy\ProcessStrategy');
    }

    function it_chooses_strategy_for_albums()
    {
        $this->beConstructedWith(Directory::ALBUM);
        $this->getStrategy()->shouldHaveType('AppBundle\Process\Strategy\Album');
    }

    function it_chooses_strategy_for_years()
    {
        $this->beConstructedWith(Directory::YEAR);
        $this->getStrategy()->shouldHaveType('AppBundle\Process\Strategy\Year');
    }

    function it_chooses_strategy_for_releases()
    {
        $this->beConstructedWith(Directory::RELEASE);
        $this->getStrategy()->shouldHaveType('AppBundle\Process\Strategy\Release');
    }

    function it_chooses_strategy_for_artists()
    {
        $this->beConstructedWith(Directory::ARTIST);
        $this->getStrategy()->shouldHaveType('AppBundle\Process\Strategy\Artist');
    }

    function it_should_be_processable()
    {
        $this->beConstructedWith(Directory::ARTIST);
        $this->process('Some Entry');
    }

    function it_should_throw_exception_on_process_without_strategy_set($someInput)
    {
        $this->beConstructedWith($someInput);
        $this->shouldThrow(new \LogicException('Strategy not set for this object'))->during('process', ['Some Entry']);
    }
}
