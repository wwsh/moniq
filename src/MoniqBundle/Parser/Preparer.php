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

namespace MoniqBundle\Parser;

/**
 * File created by Thomas Parys.
 * (C) 2016 WW Software House
 * All Rights Reserved
 */

class Preparer extends Common
{
    /**
     * @var bool
     */
    private $removeApostrophes = true;

    /**
     * Cleaning up the entry string.
     */
    protected function cleanUp()
    {
        $this->removeEntites();
        $this->removeUnderscores();
        $this->removePolishCharacters();
        $this->removeSiteBanners();
    }

    private function removeUnderscores()
    {
        $this->entry = str_replace('_', ' ', $this->entry);
    }

    private function removeEntites()
    {
        $this->entry = preg_replace_callback(
            '~&#x([0-9a-f]+);~i',
            function ($matches) {
                return chr(hexdec($matches[1]));
            },
            $this->entry
        );
    }

    private function removePolishCharacters()
    {
        $de_pl = array(
            "\xA5" => 'A',
            "\xCA" => 'E',
            "\xC6" => 'C',
            "\x8C" => 'S',
            "\xD1" => 'N',
            "\xAF" => 'Z',
            "\x8F" => 'Z',
            "\xD3" => 'O',
            "\xA3" => 'L',
            "\xB9" => 'a',
            "\xEA" => 'e',
            "\xE6" => 'c',
            "\x9C" => 's',
            "\xF1" => 'n',
            "\xBF" => 'z',
            "\x9F" => 'z',
            "\xF3" => 'o',
            "\xA3" => 'l'
        );

        $this->entry = strtr($this->entry, $de_pl);

    }

    public function fixApostrophes()
    {
        if ($this->removeApostrophes === true) {
            $this->entry = str_replace(array('`', '\''), ' ', $this->entry);
        } else {
            // just normalise
            $this->entry = str_replace('`', '\'', $this->entry);
        }
    }

    /**
     * Sometimes nasty banners like "www.music.info" are present in the filenames.
     */
    public function removeSiteBanners()
    {
        if (preg_match('/(WWW\.[A-Z\.\-]+)/i', $this->entry, $m)) {
            $this->entry = trim(str_replace($m[1], '', $this->entry));
        }
    }
}