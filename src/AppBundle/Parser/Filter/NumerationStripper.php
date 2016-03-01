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
 * Class NumerationStripper
 * @package AppBundle\Parser\Filter
 */
class NumerationStripper extends AbstractFilter implements FilterInterface
{
    /**
     * Strip remaining leading numbers or vinyl indicators.
     * If present in the artist field.
     *
     * @param $entry
     * @return mixed
     */
    public function filter($entry)
    {
        $artist = $this->parser->getArtist();

        if ((strlen($artist) == 1 or strlen($artist) == 2) and
            (preg_match('/^[0-9]+$/', $artist) or preg_match('/^[A-Ba-b]$/', $artist))
        ) {
            $this->parser->setArtist(''); // clean it 
        }

        return $entry;
    }

}
