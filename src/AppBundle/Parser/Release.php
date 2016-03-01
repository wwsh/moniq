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

namespace AppBundle\Parser;

use AppBundle\Parser\Filter\ArtistTitle;
use AppBundle\Parser\Filter\EditYearBracketFormat;
use AppBundle\Parser\Filter\FileExtensionChecker;
use AppBundle\Parser\Filter\FileExtensionRemover;
use AppBundle\Parser\Filter\IncompleteEditHandler;
use AppBundle\Parser\Filter\IncompleteParenthesesHandler;
use AppBundle\Parser\Filter\NumerationDeleter;
use AppBundle\Parser\Filter\NumerationStripper;
use AppBundle\Parser\Filter\SegmentSorter;
use AppBundle\Parser\Filter\Utf8Ensurer;
use AppBundle\Parser\Filter\YearCatDirectoryFormat;
use AppBundle\Parser\Filter\YearCatFileFormat;

class Release extends Preparer
{
    const CODE = 1;

    /**
     * @return array
     */
    protected function getFilterConfig()
    {
        return [
            new Utf8Ensurer(),
            new FileExtensionChecker(),
            new FileExtensionRemover(),
            new YearCatDirectoryFormat(),
            new YearCatFileFormat(),
            new EditYearBracketFormat(),
            new NumerationDeleter(),
            new SegmentSorter(),
            new IncompleteEditHandler(),
            new IncompleteParenthesesHandler(),
            new ArtistTitle(),
            new NumerationStripper(),
        ];
    }

    /**
     * @param $entry
     * @return array
     */
    public function parse($entry)
    {
        $this->setEntry($entry);
        $this->cleanUp();

        $parts         = $this->disassemble();
        $parts['type'] = self::CODE;

        return $parts;
    }


}
