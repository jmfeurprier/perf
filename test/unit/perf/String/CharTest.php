<?php

namespace perf\String;

/**
 *
 */
class CharTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testWithValidString()
    {
        $string = 'a';

        $perfString = new Char($string);
    }

    /**
     *
     */
    public function testWithValidPerfString()
    {
        $string = new Char('a');

        $perfString = new Char($string);
    }

    /**
     *
     */
    public function providerInvalidStrings()
    {
        return array(
            array(''),
            array('ab'),
            array('abc'),
            array(0),
            array(1),
            array(2),
            array(new \stdClass()),
            array(array()),
            array(array('a')),
            array(null),
        );
    }

    /**
     *
     * @dataProvider providerInvalidStrings
     * @expectedException InvalidArgumentException
     */
    public function testWithInvalidStrings($string)
    {
        new Char($string);
    }
}
