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
 * Class IncompleteEditHandler
 * @package MoniqBundle\Parser\Filter
 */
class IncompleteEditHandler extends AbstractFilter implements FilterInterface
{
    /**
     * Checks for incomplete edit indication in title string,
     * for example: "Baltimora - Tarzan Boy (Radio"
     *
     * @param $entry
     * @return mixed
     * @throws \Exception
     */
    public function filter($entry)
    {
        $segments = explode(self::STANDARD_SEGMENT_DELIMITER, $entry);

        if (!isset($segments[1])) {
            throw new \Exception('Segments not sorted. Invoke SegmentSorter first.');
        }

        if (!$this->parser->getEdit() && preg_match('/([\[\(]([^\)^\]]*(' . self::EDIT_REGEX_PART . ')[^\)^\]]*))$/i',
                                                    $segments[1], $matches)
        ) {
            $this->parser->setEdit($matches[2]);
            // cut the string from title
            $segments[1] = str_replace($matches[1], '', $segments[1]);
            $segments[1] = trim($segments[1]);
        }

        $entry = implode(self::STANDARD_SEGMENT_DELIMITER, $segments);

        return $entry;
    }

}
