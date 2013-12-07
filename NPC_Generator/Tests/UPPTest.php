<?php

namespace NPC_Generator\Test;
// require_once 'autoload.php';
require_once 'Trooper.php';
// require_once 'Being.php';

// use NPC_Generator\Trooper;

class UPPTest extends \PHPUnit_Framework_TestCase
{

    public $testUPP;

    protected function setup()
    {
        // $trooper = new NPC_Generator\Trooper(new NPC_Generator\NCOParams);
        $trooper = new Trooper(new NCOParams);
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

