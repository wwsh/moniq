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
 * Class EditYearBracketFormat
 * @package MoniqBundle\Parser\Filter
 */
class EditYearBracketFormat extends AbstractFilter implements FilterInterface
{
    /**
     * Extracts the "edit" information.
     * Check all parenthese groups and classify them (edit, non edit).
     * Remove all split chars inside parentheses.
     *
     * @param $entry
     * @return mixed
     */
    public function filter($entry)
    {
        // Format: "(Special Version)"
        if (!preg_match_all('/([\[\(]\s*([^\]^\)]+)\s*[\]\)])/', $entry, $matches)) {
            return $entry;
        }

        foreach ($matches[1] as $id => $match) {
            if (preg_match('/' . self::EDIT_REGEX_PART . '/i',
                           $match)) {
                $this->parser->setEdit(trim($matches[2][$id])); // could be the song version indication
                $replaced = str_replace($match, '', $entry);
                $entry    = trim($replaced); // drop from entry
            } elseif (preg_match('/^[1-2][0-9][0-9][0-9]$/',
                                 $matches[2][$id])) { // could be just the release year in brackets?
                $this->parser->setYear($matches[2][$id]);
                $entry = trim(str_replace($match, '', $entry));
            } else {
                // check and remove split chars inside this parentheses group
                $replaced = preg_replace('/\s*[\/\-]\s+/', '-', $match);
                $entry    = str_replace($match, $replaced, $entry);
            }
        }

        return $entry;
    }

}
