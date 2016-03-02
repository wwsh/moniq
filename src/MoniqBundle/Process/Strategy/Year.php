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

namespace MoniqBundle\Process\Strategy;

use MoniqBundle\Driver\NullOutput;
use MoniqBundle\Driver\OutputInterface;

class Year implements StrategyInterface
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * Year constructor.
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output = null)
    {
        $this->output = $output;

        if (null === $output) {
            $this->output = new NullOutput();
        }
    }

    /**
     * @param $entry
     * @return array
     */
    public function process($entry)
    {
        $this->output->out('Y: ' . $entry);

        $parts = $this->parser($entry);
        return $parts;
    }

    /**
     * @param $entry
     * @return array
     */
    private function parser($entry)
    {
        $parser = new \MoniqBundle\Parser\Year();
        $parts  = $parser->parse($entry);
        return $parts;
    }

}
