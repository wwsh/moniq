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

namespace spec\AppBundle\Storage\Driver;

use Doctrine\ODM\MongoDB\DocumentManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MongoSpec extends ObjectBehavior
{
    function it_is_initializable(DocumentManager $dm)
    {
        $this->beConstructedWith($dm);
        $this->shouldHaveType('AppBundle\Storage\Driver\Mongo');
    }

    function it_persists_documents(DocumentManager $dm)
    {
        $dm->persist(Argument::any())->shouldBeCalled();
        $dm->flush(Argument::any())->shouldBeCalled();
        $this->beConstructedWith($dm);
        $this->save([
                        [
                            'artist'  => 'text',
                            'title'   => 'text',
                            'type'    => 'text',
                            'cat'     => 'text',
                            'year'    => '1991',
                            'sampler' => false,
                            'edit'    => 'text',
                        ]
                    ]);
    }
}