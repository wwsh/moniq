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

namespace MoniqBundle\Storage\Driver;

use MoniqBundle\Document\Collection;
use MoniqBundle\Storage\Driver\Mongo\CollectionFactory;
use MoniqBundle\Storage\StorageInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Class Mongo
 * @package MoniqBundle\Storage\Driver
 */
class Mongo implements StorageInterface
{
    /**
     * Doctrine manager.
     *
     * @var
     */
    private $dm;

    /**
     * Mongo constructor.
     * @param DocumentManager $dm
     */
    public function __construct($dm)
    {
        $this->dm = $dm;
    }

    /**
     * Saves a collection to the mongo database.
     *
     * @param $input An array collection of data in internal format, to be dumped to DB.
     * @return bool
     */
    public function save($input)
    {
        if (!is_array($input) || empty($input)) {
            return false;
        }

        foreach ($input as $item) {
            $document = CollectionFactory::create($item);
            foreach ($document->getEntries() as $entry) {
                $this->dm->persist($entry);
                $this->dm->flush();
            }
            $this->dm->persist($document);
            $this->dm->flush();
        }

        return true;
    }


}
