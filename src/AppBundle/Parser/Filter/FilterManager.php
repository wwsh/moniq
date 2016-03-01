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

use AppBundle\Factory\FilterFactory;
use AppBundle\Parser\Common;

/**
 * Class Manager
 * @package AppBundle\Parser\Filter
 */
class FilterManager
{
    /**
     * @var FilterInterface[]
     */
    private $filterChain;

    /**
     * Manager constructor.
     * @param Common $parser
     */
    public function __construct(Common $parser)
    {
        $this->parser      = $parser;
        $this->filterChain = [];
    }

    /**
     * @param FilterInterface[] $filters
     * @return $this
     */
    public function init($filters)
    {
        if (!is_array($filters)) {
            throw new \InvalidArgumentException('Accepting array of filter names');
        }

        foreach ($filters as $filter) {
            $filter->setParser($this->parser); // setter injection
            $this->filterChain[] = $filter;
        }

        return $this;
    }

    /**
     * Running all the filters.
     * The result stored in parser and returned.
     *
     * @return Common
     */
    public function run()
    {
        $entry = $this->parser->getEntry();

        foreach ($this->filterChain as $filter) {
            $entry = $filter->filter($entry);
        }

        $this->parser->setEntry($entry);

        return $this->parser;
    }


}
