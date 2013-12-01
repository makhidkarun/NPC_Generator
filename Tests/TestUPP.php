<?php

class UPPTest extends PHPUnit_Framework_TestCase
{

    public $testUPP;

    protected function setup()
    {
        $this->testUPP = '2A3B4F';
    }

    public function testRegex()
    {
        $this->assertStringMatchesFormat('%x', "$this->testUPP");
    }

    public function testLength()
    {
        $this->assertEquals(strlen($this->testUPP), 6);
    }
}

