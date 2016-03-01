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

namespace AppBundle\Parser;

/**
 * File created by Thomas Parys.
 * (C) 2016 WW Software House
 * All Rights Reserved
 */
use AppBundle\Parser\Filter\FilterManager;

/**
 * Class Common
 * @package AppBundle\Parser
 */
class Common
{
    /**
     * The input.
     * This is the filename text entry that is being worked on by all descendants.
     * Brought as a property to make it easier to manipulate (no passing as variable required).
     *
     * @var string
     */
    protected $entry = '';

    /**
     * An output.
     * Edit found.
     *
     * @var string
     */
    protected $edit = '';

    /**
     * An output.
     * Year of release found.
     *
     * @var string
     */
    protected $year = '';

    /**
     * An output.
     * Artist found.
     *
     * @var string
     */
    protected $artist = '';

    /**
     * An output.
     * Title found.
     *
     * @var string
     */
    protected $title = '';

    /**
     * An output.
     * Catalogue number found.
     *
     * @var
     */
    protected $cat = '';


    /**
     * @return string
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * @param string $entry
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;
    }

    /**
     * @param mixed $cat
     */
    public function setCat($cat)
    {
        $this->cat = $cat;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @param string $edit
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;
    }

    /**
     * @return string
     */
    public function getEdit()
    {
        return $this->edit;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * The main disassembler, splitting filename elements into parts.
     *
     * @return array|bool
     */
    public function disassemble()
    {
        $manager = new FilterManager($this);
        $manager->init($this->getFilterConfig())
                ->run();

        $sampler = $this->samplerCheck();

        return [
            'artist'  => $this->artist,
            'title'   => $this->title,
            'year'    => $this->year,
            'edit'    => $this->edit,
            'cat'     => $this->cat,
            'sampler' => $sampler,
        ];
    }

    /**
     * Check if we're dealing with a sampler release.
     *
     * @return mixed
     */
    private function samplerCheck()
    {
        $sampler = preg_match('/V\.A\./', $this->artist);

        return $sampler;
    }

    /**
     * Should return an array of filter objects.
     * Order is preserved in execution chain.
     *
     * @return array
     */
    protected function getFilterConfig()
    {
        return [];
    }


}