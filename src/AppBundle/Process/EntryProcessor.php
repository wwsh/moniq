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

namespace AppBundle\Process;

use AppBundle\Analyzer\Directory;
use AppBundle\Driver\OutputInterface;
use AppBundle\Exception\SamplerContainerDirectoryException;
use AppBundle\Process\Strategy\ProcessStrategy;

/**
 * Class Directory
 * @package AppBundle\Process
 */
class EntryProcessor implements EntryProcessorInterface
{
    /**
     * @var OutputInterface|null
     */
    private $output;

    /**
     * If set, forces specific type of parsed data entries.
     *
     * @var integer
     */
    private $enforcedType;


    /**
     * EntryProcessor constructor.
     * @param OutputInterface|null $output
     */
    public function __construct(OutputInterface $output = null)
    {
        $this->output       = $output;
        $this->enforcedType = null;
    }

    /**
     * @return int
     */
    public function getEnforcedType()
    {
        return $this->enforcedType;
    }


    /**
     * @param $entry
     * @return bool
     * @throws SamplerContainerDirectoryException
     * @throws \Exception
     */
    public function process($entry)
    {
        $type = $this->enforcedType;

        // type enforcement works inline only
        $this->enforcedType = null;

        if (null === $type) {
            $analyzer = new \AppBundle\Analyzer\Directory($entry);
            $type     = $analyzer->getType();

            if (null === $type) {
                throw new \Exception('Unsupported directory format: ' . $entry);
            }

            if (Directory::CONTAINER_DIR === $type) {
                throw new SamplerContainerDirectoryException();
            }
        }

        $strategy = new ProcessStrategy($type, $this->output);

        return $strategy->process($entry);
    }

    /**
     * @param $type
     * @return $this
     */
    public function treatAs($type)
    {
        $this->enforcedType = $type;
        return $this;
    }

}
