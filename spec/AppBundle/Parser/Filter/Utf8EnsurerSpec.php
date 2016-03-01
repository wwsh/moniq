<?php

namespace spec\AppBundle\Parser\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Utf8EnsurerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Parser\Filter\Utf8Ensurer');
    }
}
