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

namespace AppBundle\Process\Strategy;

use AppBundle\Analyzer\Directory;
use AppBundle\Driver\OutputInterface;
use JMS\Serializer\Exception\LogicException;

class ProcessStrategy
{
    /**
     * @var Album
     */
    private $strategy;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * Context constructor.
     * @param $selector
     * @param OutputInterface $output
     */
    public function __construct($selector, OutputInterface $output = null)
    {
        $this->output = $output;

        if (!is_int($selector)) {
            return;
        }

        switch ($selector) {
            case Directory::ALBUM:
                $this->strategy = new Album($this->output);
                break;
            case Directory::YEAR:
                $this->strategy = new Year($this->output);
                break;
            case Directory::RELEASE:
                $this->strategy = new Release($this->output);
                break;
            case Directory::ARTIST:
                $this->strategy = new Artist($this->output);
                break;
        }
    }

    /**
     * @return Album
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param $entry
     * @return bool
     */
    public function process($entry)
    {
        if ($this->strategy === null) {
            throw new LogicException('Strategy not set for this object');
        }

        return $this->strategy->process($entry);
    }

}
