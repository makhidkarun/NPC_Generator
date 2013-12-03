<?php

require_once 'autoload.php';
//require_once 'NPC_Generator/Trooper.php';
// namespace NPC_Generator;

class UPPTest extends \PHPUnit_Framework_TestCase
{

    public $testUPP;

    protected function setup()
    {
        $trooper = new \NPC_Generator\Trooper(new \NPC_Generator\NCOParams);
        $this->testUPP = $trooper->getUPP();
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

