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

namespace AppBundle\Storage\Driver\Mongo;

use AppBundle\Document\Collection;

/**
 * Class CollectionMapper
 * @package AppBundle\Storage\Driver\Mongo
 */
class CollectionFactory
{
    /**
     * @param $data
     * @return Collection|null
     */
    public static function create($data)
    {
        if (empty($data)) {
            return null;
        }

        $document = new Collection();
        $document->setArtist($data['artist'])
                 ->setTitle($data['title'])
                 ->setType($data['type'])
                 ->setCat($data['cat'])
                 ->setYear($data['year'])
                 ->setSampler($data['sampler'])
                 ->setEdit($data['edit']);

        if (isset($data['contents']) && !empty($data['contents'])) {
            foreach ($data['contents'] as $entryData) {
                $entry = EntryFactory::create($entryData);
                $document->addEntry($entry);
            }
        }

        return $document;
    }

}
