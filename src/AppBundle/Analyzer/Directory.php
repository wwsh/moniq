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

namespace AppBundle\Analyzer;

class Directory
{
    const ARTIST        = 1;
    const YEAR          = 2;
    const ALBUM         = 3;
    const RELEASE       = 4;
    const CONTAINER_DIR = 5;

    /**
     * @var string
     */
    private $entry;

    /**
     * Directory constructor.
     * @param $entry
     */
    public function __construct($entry = null)
    {
        $this->entry = (string)$entry;
    }

    /**
     * Directory name formats supported.
     * Refer to the documentation to see this list explained.
     *
     * @return int|null
     */
    public function getType()
    {
        if (preg_match('/^CD[0-9]+$/', $this->entry) ||
            preg_match('/^Disc\s?[0-9]+$/', $this->entry)
        ) {
            return self::CONTAINER_DIR;
        }

        if (preg_match('/^[0-9]+\s\-\s[0-9]+$/', $this->entry)) {
            return self::YEAR;
        }

        if (preg_match('/^[0-9][0-9][0-9][0-9]\s[^\[]+(\[[^\]]+\])?$/', $this->entry)) {
            return self::RELEASE;
        }

        if (preg_match('/\s\-\s/', $this->entry)) {
            return self::ALBUM;
        }

        if ($this->entry) {
            return self::ARTIST;
        }

        return null;
    }
}
