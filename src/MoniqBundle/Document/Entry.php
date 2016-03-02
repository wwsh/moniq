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

namespace MoniqBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Data entry.
 *
 * @ODM\Document
 */
class Entry
{
    /**
     * @ODM\Id(strategy="auto")
     */
    private $id;

    /**
     * @ODM\String
     * @var string
     */
    private $artist;

    /**
     * @ODM\String
     * @var string
     */
    private $title;

    /**
     * @ODM\String
     * @var string
     */
    private $edit;

    /**
     * @ODM\Integer
     * @var int
     */
    private $year;

    /**
     * @ODM\String
     * @var string
     */
    private $cat;

    /**
     * @ODM\String
     * @var string
     */
    private $lyrics;

    /**
     * @ODM\String
     * @var string
     */
    private $music;

    /**
     * @ODM\String
     * @var string
     */
    private $arranger;

    /**
     * @ODM\String
     * @var string
     */
    private $publisher;

    /**
     * @ODM\String
     * @var string
     */
    private $time;

    /**
     * @ODM\Integer
     * @var int
     */
    private $count;

    /**
     * @ODM\Boolean
     * @var boolean
     */
    private $sampler;

    /**
     * @ODM\String
     * @var string
     */
    private $mountPoint;

    /**
     * @ODM\Integer
     * @var integer
     */
    private $type;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set artist
     *
     * @param string $artist
     * @return self
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
        return $this;
    }

    /**
     * Get artist
     *
     * @return string $artist
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set edit
     *
     * @param string $edit
     * @return self
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;
        return $this;
    }

    /**
     * Get edit
     *
     * @return string $edit
     */
    public function getEdit()
    {
        return $this->edit;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return self
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * Get year
     *
     * @return integer $year
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set cat
     *
     * @param string $cat
     * @return self
     */
    public function setCat($cat)
    {
        $this->cat = $cat;
        return $this;
    }

    /**
     * Get cat
     *
     * @return string $cat
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * Set lyrics
     *
     * @param string $lyrics
     * @return self
     */
    public function setLyrics($lyrics)
    {
        $this->lyrics = $lyrics;
        return $this;
    }

    /**
     * Get lyrics
     *
     * @return string $lyrics
     */
    public function getLyrics()
    {
        return $this->lyrics;
    }

    /**
     * Set music
     *
     * @param string $music
     * @return self
     */
    public function setMusic($music)
    {
        $this->music = $music;
        return $this;
    }

    /**
     * Get music
     *
     * @return string $music
     */
    public function getMusic()
    {
        return $this->music;
    }

    /**
     * Set arranger
     *
     * @param string $arranger
     * @return self
     */
    public function setArranger($arranger)
    {
        $this->arranger = $arranger;
        return $this;
    }

    /**
     * Get arranger
     *
     * @return string $arranger
     */
    public function getArranger()
    {
        return $this->arranger;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     * @return self
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * Get publisher
     *
     * @return string $publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return self
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get time
     *
     * @return string $time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return self
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Get count
     *
     * @return integer $count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set sampler
     *
     * @param boolean $sampler
     * @return self
     */
    public function setSampler($sampler)
    {
        $this->sampler = $sampler;
        return $this;
    }

    /**
     * Get sampler
     *
     * @return boolean $sampler
     */
    public function getSampler()
    {
        return $this->sampler;
    }

    /**
     * Set mountPoint
     *
     * @param string $mountPoint
     * @return self
     */
    public function setMountPoint($mountPoint)
    {
        $this->mountPoint = $mountPoint;
        return $this;
    }

    /**
     * Get mountPoint
     *
     * @return string $mountPoint
     */
    public function getMountPoint()
    {
        return $this->mountPoint;
    }

    /**
     * Set type
     *
     * @param int $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }
}
