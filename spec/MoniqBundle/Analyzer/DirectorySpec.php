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

namespace spec\MoniqBundle\Analyzer;

use MoniqBundle\Analyzer\Directory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DirectorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MoniqBundle\Analyzer\Directory');
    }

    function it_accepts_string_in_constructor()
    {
        $this->beConstructedWith('Some Directory');
        $this->shouldHaveType('MoniqBundle\Analyzer\Directory');
    }

    function it_determines_directory_entry_artist_type()
    {
        $this->beConstructedWith('Diesel Action');
        $this->getType()->shouldReturn(Directory::ARTIST);
    }

    function it_determines_directory_entry_release_type()
    {
        $this->beConstructedWith('1990 MC Hammer - Please Hammer Don\'t Hurt Em');
        $this->getType()->shouldReturn(Directory::RELEASE);
    }

    function it_determines_directory_entry_year_type()
    {
        $this->beConstructedWith('1980 - 1989');
        $this->getType()->shouldReturn(Directory::YEAR);
    }

    function it_determines_directory_entry_album_type()
    {
        $this->beConstructedWith('Enya - Greatest Hits');
        $this->getType()->shouldReturn(Directory::ALBUM);

    }

    function it_determines_disc_container_type()
    {
        $this->beConstructedWith('Disc 01');
        $this->getType()->shouldReturn(Directory::CONTAINER_DIR);
    }

    function it_determines_cd_container_type()
    {
        $this->beConstructedWith('CD6');
        $this->getType()->shouldReturn(Directory::CONTAINER_DIR);
    }

}
