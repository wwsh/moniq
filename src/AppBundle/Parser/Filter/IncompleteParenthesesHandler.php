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
 * Class IncompleteParenthesesHandler
 * @package AppBundle\Parser\Filter
 */
class IncompleteParenthesesHandler extends AbstractFilter implements FilterInterface
{
    /**
     * Check for incomplete parentheses and/or strikes at the end of each segment.
     *
     * @param $entry
     * @return mixed
     */
    public function filter($entry)
    {
        $segments = explode(self::STANDARD_SEGMENT_DELIMITER, $entry);

        foreach ($segments as &$segment) {
            //
            if (preg_match('/(\(|\-)$/', $segment)) {
                $segment = substr($segment, 0, strlen($segment) - 1); // delete
            }
        }

        $entry = implode(self::STANDARD_SEGMENT_DELIMITER, $segments);

        return $entry;
    }

}