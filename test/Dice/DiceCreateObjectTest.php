<?php

namespace Seva19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Seva19\Dice\Dice", $dice);
    }



    /**
     * Construct object and test random method roll.
     */
    public function testCreateObjectAndTestRoll()
    {
        $dice= new Dice();

        $rand = $dice->roll();
        $arr = array(1, 2, 3, 4, 5, 6);

        $res = in_array($rand, $arr);

        $this->assertEquals(true, $res);
    }



    /**
     * Construct object and test method graphic.
     */
    public function testCreateObjectAndTestGraphics()
    {
        $dice= new Dice();

        $rand = $dice->roll();
        $exp = "dice-" . $rand;

        $res = $dice->graphic();


        $this->assertEquals($exp, $res);
    }
}
