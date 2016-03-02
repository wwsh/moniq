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

namespace MoniqBundle\Service;

use MoniqBundle\Browser\DirectoryBrowser;
use MoniqBundle\Driver\OutputInterface;
use MoniqBundle\Storage\StorageInterface;

/**
 * Class Scanner
 * @package MoniqBundle\Services
 */
class Scanner
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var DirectoryBrowser
     */
    private $browser;

    /**
     * @var StorageInterface
     */
    private $storage;


    /**
     * Scanner constructor.
     * @param null $browser Browser service.
     * @param StorageInterface|null $storage Storage driver (mongo).
     */
    public function __construct($browser = null, StorageInterface $storage = null)
    {
        $this->browser = $browser;
        $this->storage = $storage;
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
     * Scans and processes all elements in the given directory.
     */
    public function run()
    {
        $result = $this->browser->run();

        return $this->storage->save($result);
    }


}
