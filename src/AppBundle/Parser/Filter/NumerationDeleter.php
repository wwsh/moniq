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
 * Class NumerationDeleter
 * @package AppBundle\Parser\Filter
 */
class NumerationDeleter extends AbstractFilter implements FilterInterface
{
    /**
     * This is killing all leading numeration in the filenames, like:
     * 01 - Village People - YMCA => Village People - YMCA
     * A - Carlo Resoort - 'O' Class => Carlo Resoort - 'O' Class
     *
     * @param $entry
     * @return mixed
     */
    public function filter($entry)
    {
        $segments = preg_split('/\s*[\/\-\|]\s+/', $entry);

        $count = 1;
        foreach ($segments as $id => $segment) {
            // make sure we're not touching the last segment (the cat info)
            if (count($segments) > $count) {
                $segments[$id] = preg_replace('/^[\(\[]?[0-9ABab][0-9]\s*[\]\)\/\-\.]\s*/', '', $segment);
            }
            $count++;
        }

        $entry = implode(self::STANDARD_SEGMENT_DELIMITER, $segments);

        return $entry;
    }

}
