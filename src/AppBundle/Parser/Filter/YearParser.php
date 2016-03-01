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

namespace AppBundle\Parser\Filter;

/**
 * Class YearParser
 * @package AppBundle\Parser\Filter
 */
class YearParser extends AbstractFilter implements FilterInterface
{
    /**
     * The year directory format as follows:
     * "[YEAR] - [YEAR]"
     * "[YEAR]+"
     * "[YEAR]"
     *
     * @param $entry
     * @return mixed
     * @throws \Exception
     */
    public function filter($entry)
    {
        if (preg_match('/^([0-9]+)\s\-\s([0-9]+)$/', $entry, $matches)) {
            $this->parser->setYear($matches[1] . ' - ' . $matches[2]);
            return;
        }

        if (preg_match('/^([0-9]+)\+$/', $entry, $matches)) {
            $this->parser->setYear($matches[1] . '+');
            return;
        }

        if (preg_match('/^([0-9]+)$/', $entry, $matches)) {
            $this->parser->setYear($matches[1]);
            return;
        }

        throw new \Exception('Unknown year directory format');
    }
}
