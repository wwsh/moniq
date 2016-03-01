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

namespace AppBundle\Tests\Parser;

/**
 * File created by Thomas Parys.
 * (C) 2016 WW Software House
 * All Rights Reserved
 */

use AppBundle\Browser\DirectoryBrowser;
use AppBundle\Process\EntryProcessor;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use WW\Vfs\Factory\FileSystemFactory;

class DirectoryBrowserTest extends TestCase
{
    /**
     * @var DirectoryBrowser
     */
    private $test;

    public function setUp()
    {
        $processor  = new EntryProcessor();
        $iterator   = FileSystemFactory::create('vfs', ['/music', __DIR__.'/../../../src/AppBundle/Resources/vfs/example.json']);
        $this->test = new DirectoryBrowser($iterator, $processor);
    }

    public function test_directory_browsing()
    {
        $expected =
            [
                [
                    "artist"   => 'Haddaway',
                    "title"    => 'What Is Love',
                    "year"     => '1993',
                    "edit"     => 'Remixes',
                    "cat"      => '',
                    "sampler"  => 0,
                    "type"     => 1,
                    "contents" => [
                        0 =>
                            [
                                "artist"  => 'Haddaway',
                                "title"   => 'What Is Love',
                                "year"    => '',
                                "edit"    => "7'' Mix",
                                "cat"     => '',
                                "sampler" => 0,
                                "type"    => 1,
                            ],

                        1 => [

                            "artist"  => 'Haddaway',
                            "title"   => 'What Is Love',
                            "year"    => '',
                            "edit"    => 'Eat This Mix',
                            "cat"     => '',
                            "sampler" => 0,
                            "type"    => 1,
                        ],

                        2 => [
                            "artist"  => 'Haddaway',
                            "title"   => 'What Is Love',
                            "year"    => '',
                            "edit"    => 'Tour De Trance Mix',
                            "cat"     => '',
                            "sampler" => 0,
                            "type"    => 1,
                        ]
                    ]
                ],

                [

                    "artist"   => 'Paul Hardcastle',
                    "title"    => '19 (The Final Story)',
                    "year"     => '1985',
                    "edit"     => '',
                    "cat"      => "[601 814]",
                    "sampler"  => 0,
                    "type"     => 1,
                    "contents" => [
                        0 =>
                            [
                                "artist"  => 'Paul Hardcastle',
                                "title"   => '19 (The Final Story)',
                                "year"    => '',
                                "edit"    => '',
                                "cat"     => '',
                                "sampler" => 0,
                                "type"    => 1,
                            ],

                        1 => [
                            "artist"  => 'Paul Hardcastle',
                            "title"   => '19',
                            "year"    => '',
                            "edit"    => 'Destruction Mix',
                            "cat"     => '',
                            "sampler" => 0,
                            "type"    => 1,
                        ]

                    ]

                ]

            ];


        $result = $this->test->run();
        assertThat($result, is(equalTo($expected)));
    }
}