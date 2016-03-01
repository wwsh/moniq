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

namespace spec\AppBundle\Parser\Filter;

use AppBundle\Parser\Filter\ArtistTitle;
use AppBundle\Parser\Filter\SegmentSorter;
use AppBundle\Parser\Release;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilterManagerSpec extends ObjectBehavior
{
    function it_should_be_constructed_with_context(Release $parser)
    {
        $this->beConstructedWith($parser);
        $this->shouldHaveType('AppBundle\Parser\Filter\FilterManager');
    }

    function it_should_throw_exception_on_bad_init(Release $parser)
    {
        $this->beConstructedWith($parser);
        $this->shouldThrow(new \InvalidArgumentException('Accepting array of filter names'))->during('init', [$parser]);
    }

    function it_should_initialize_custom_filters_and_run_them(Release $parser)
    {
        $parser->getEntry()->shouldBeCalled()->willReturn('Artist - Title');
        $parser->setEntry('Artist - Title')->shouldBeCalled();
        $parser->setArtist('Artist')->shouldBeCalled();
        $parser->setTitle('Title')->shouldBeCalled();
        $this->beConstructedWith($parser);
        $this->init([new SegmentSorter(), new ArtistTitle()]);
        $this->run();

    }
}
