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

namespace MoniqBundle\Parser\Filter;

/**
 * Class SegmentSorter
 * @package MoniqBundle\Parser\Filter
 */
class SegmentSorter extends AbstractFilter implements FilterInterface
{
    /**
     * Sorting segments, removing overload.
     *
     * @param $entry
     * @return mixed
     * @throws \Exception
     */
    public function filter($entry)
    {
        $segments = explode(self::STANDARD_SEGMENT_DELIMITER, $entry);

        // songname has to be artist / title in that order
        if (count($segments) < 2) {
            throw new \Exception('Invalid number of segments in filename');
        }

        // too many segments? we have to pick 2
        while (count($segments) > 2) {
            // remove same segments unless there are just 2
            $segments = array_unique($segments);
            if (count($segments) < 2) {
                // oops! reduced too much, double single element into two
                array_push($segments, $segments[key($segments)]);
            }
            foreach ($segments as $id => $segment) {
                // the compilation case: remove unnecessary VA info
                if (preg_match('/^(VA|V\.A\.|V\.A|VARIOUS|NIEZNANY|VARIOUS ARTISTS|UNKNOWN ARTIST)$/i', $segment)) {
                    unset($segments[$id]);
                    $segments = array_values($segments); // rekey array
                    break;
                }
            }
            // remove all leading stuff (italo disco -, billboard hits top100 -, etc.)
            $segments = array_slice($segments, count($segments) - 2, 2);
        }

        $entry = implode(self::STANDARD_SEGMENT_DELIMITER, $segments);

        return $entry;
    }

}
