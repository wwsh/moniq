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
 * Class YearCatFileFormat
 * @package AppBundle\Parser\Filter
 */
class YearCatFileFormat extends AbstractFilter implements FilterInterface
{
    /**
     * Check for year release and catalogue number indication (file, postfix version)
     * "[RELEASE.....], [YEAR] [CAT]"
     *
     * @param $entry
     * @return mixed
     */
    public function filter($entry)
    {
        if (preg_match('/(,\s([0-9][0-9][0-9][0-9])(\s([a-z\ A-Z0-9\-\.]+))?\s*)$/', $entry, $matches)) {
            $this->parser->setYear($matches[2]);
            if (isset($matches[3])) {
                $this->parser->setCat($matches[3]);
            }
            // cleanup - no longer used
            $entry = trim(str_replace($matches[1], '', $entry));
        }

        return $entry;
    }

}
