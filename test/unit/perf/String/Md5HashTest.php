<?php

namespace perf\String;

/**
 *
 */
class Md5HashTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testWithValidString()
    {
        $perfString = new Md5Hash('0123456789abcdef0123456789abcdef');
    }

    /**
     *
     */
    public function testWithValidPerfString()
    {
        $string = new Md5Hash('0123456789abcdef0123456789abcdef');

        $perfString = new Md5Hash($string);
    }

    /**
     *
     */
    public function providerInvalidStrings()
    {
        return array(
            array(''),
            array('0123456789abcdef0123456789abcdef0'),
            array('0123456789abcdef0123456789abcde'),
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
     * @expectedException \InvalidArgumentException
     */
    public function testWithInvalidStrings($string)
    {
        new Md5Hash($string);
    }
}
