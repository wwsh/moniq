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

use AppBundle\Parser\Release;
use AppBundle\Parser\Filter\ArtistTitle;
use AppBundle\Parser\Filter\EditYearBracketFormat;
use AppBundle\Parser\Filter\IncompleteEditHandler;
use AppBundle\Parser\Filter\IncompleteParenthesesHandler;
use AppBundle\Parser\Filter\NumerationDeleter;
use AppBundle\Parser\Filter\NumerationStripper;
use AppBundle\Parser\Filter\SegmentSorter;
use AppBundle\Parser\Filter\YearCatDirectoryFormat;
use AppBundle\Parser\Filter\YearCatFileFormat;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * File created by Thomas Parys.
 * (C) 2016 WW Software House
 * All Rights Reserved
 */
class ReleaseTest extends TestCase
{
    /**
     * @var Release
     */
    private $test;

    /**
     *
     */
    public function setUp()
    {
        $this->test = new Release();
    }

    /**
     * @dataProvider data
     * @param $inputEntry
     * @param $outputStructure
     */
    public function testDisassemble($inputEntry, $outputStructure)
    {
        $this->test->setEntry($inputEntry);
        $output = $this->test->disassemble();

        foreach (['artist', 'title', 'year', 'cat', 'edit'] as $key) {
            if (isset($outputStructure[$key])) {
                assertThat($output[$key], is(equalTo($outputStructure[$key])));
            }
        }
    }

    /**
     * Data provider.
     * 
     * @return array
     */
    public function data()
    {
        return [
            [
                '1983 Wham! - Club Tropicana (UK 12\'\')',
                [
                    'artist' => 'Wham!',
                    'title'  => 'Club Tropicana',
                    'year'   => '1983',
                    'cat'    => '',
                    'edit'   => 'UK 12\'\'',
                ]
            ],
            [
                '1999 DJ Valium - Go Right For',
                [
                    'artist' => 'DJ Valium',
                    'title'  => 'Go Right For',
                    'year'   => '1999',
                    'cat'    => '',
                    'edit'   => '',
                ]
            ],
            [
                '1999 DJ Valium - Keep Da Klubstyle [743 21661862]',
                [
                    'artist' => 'DJ Valium',
                    'title'  => 'Keep Da Klubstyle',
                    'year'   => '1999',
                    'cat'    => '[743 21661862]',
                    'edit'   => '',
                ]
            ],
            [
                'Modern English - Ink And Paper, 1986',
                [
                    'artist' => 'Modern English',
                    'title'  => 'Ink And Paper',
                    'year'   => '1986',
                    'cat'    => '',
                    'edit'   => '',
                ]
            ],
            [
                'F.R. David - Pick Up The Phone',
                [
                    'artist' => 'F.R. David',
                    'title'  => 'Pick Up The Phone',
                    'year'   => '',
                    'cat'    => '',
                    'edit'   => '',
                ]
            ],
            [
                'Illyus & Barrientos, Max Marshall - Chase Your Trip (Original Mix)',
                [
                    'artist' => 'Illyus & Barrientos, Max Marshall',
                    'title'  => 'Chase Your Trip',
                    'year'   => '',
                    'cat'    => '',
                    'edit'   => 'Original Mix',
                ]
            ],
            [
                '1992 Daisy Dee - Walking On That Side [DST 1.117-12]',
                [
                    'artist' => 'Daisy Dee',
                    'title'  => 'Walking On That Side',
                    'year'   => '1992',
                    'cat'    => '[DST 1.117-12]',
                    'edit'   => '',
                ]
            ]
        ];
    }
}