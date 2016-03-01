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

use AppBundle\Parser\Filter\Utf8Ensurer;
use AppBundle\Parser\Filter\YearParser;

/**
 * Class Year
 * @package AppBundle\Parser
 */
class Year extends Preparer
{
    const CODE = 1;

    /**
     * @return array
     */
    protected function getFilterConfig()
    {
        return [
            new Utf8Ensurer(),
            new YearParser()
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
