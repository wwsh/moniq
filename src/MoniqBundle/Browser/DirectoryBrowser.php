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

namespace MoniqBundle\Browser;

use MoniqBundle\Analyzer\Directory;
use MoniqBundle\Driver\OutputInterface;
use MoniqBundle\Exception\SamplerContainerDirectoryException;
use MoniqBundle\Process\EntryProcessorInterface;
use WW\Vfs\Iterator\IteratorInterface;

class DirectoryBrowser
{
    /**
     * @var IteratorInterface
     */
    private $iterator;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var EntryProcessorInterface
     */
    private $processor;


    /**
     * Scanner constructor.
     * @param $iterator
     * @param null $processor
     */
    public function __construct($iterator, $processor = null)
    {
        $this->iterator  = $iterator;
        $this->processor = $processor;

        $this->optionalTypeEnforcement = null;
    }

    /**
     * @param mixed $output
     * @return $this
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Runs through the directory, scans it and processes all elements.
     */
    public function run()
    {
        $results = [];

        $iterator = $this->iterator;
        $iterator->rewind();
        $this->out('Browsing path ' . $iterator->getPath() . '...');

        while ($iterator->valid()) {
            $item = $iterator->current();

            $filename = $item->getFilename();

            if ($item->isFile() || $filename === '.' || $filename === '..') {
                $iterator->next();
                continue;
            }

            if (null !== $this->processor) {
                $this->out('Processing directory ' . $filename);
                $result = $this->processor->process($filename);
                $files  = $this->browseFiles($iterator);

                $result['contents'] = $files;

                $results[] = $result;
            } else {
                $this->out('Found directory ' . $item->getFilename());
            }


            $iterator->next();
        }

        return $results;
    }

    /**
     * Browsing directory for files and returns disassembled part collection.
     *
     * @param IteratorInterface $iterator
     * @return array
     */
    private function browseFiles($iterator)
    {
        $results = [];

        $iterator = $iterator->getChildren();

        while ($iterator->valid()) {
            $item     = $iterator->current();
            $filename = $item->getFilename();

            if ($filename === '.' || $filename === '..') {
                $iterator->next();
                continue;
            }

            try {
                if (null !== $this->processor) {
                    // treat all file entries as "releases"
                    try {
                        $results[] = $this->processor->treatAs(Directory::RELEASE)->process($filename);
                    } catch (\Exception $e) {
                        $this->out('<error>Skipped ' . $filename . ' (' . $e->getMessage() . ')</error>');
                    }
                }
            } catch (SamplerContainerDirectoryException $e) {
                // The entry is a subdirectory, like CD1, and needs to be specifically explored
                $results += $this->browseFiles($item);
            }


            $iterator->next();
        }

        return $results;
    }

    /**
     * @param $message
     */
    private function out($message)
    {
        if ($this->output === null) {
            return; // dummy device
        }

        $this->output->out($message);
    }


}
