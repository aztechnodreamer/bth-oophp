<?php

namespace Seva19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceHandCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Seva19\Dice\DiceHand", $diceHand);

        $res = $diceHand->values();
        $exp = null;
        $this->assertEquals($exp, $res[0]);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use argument.
     */
    public function testCreateObjectArgument()
    {
        $diceHand = new DiceHand(2);
        $this->assertInstanceOf("\Seva19\Dice\DiceHand", $diceHand);

        $res = $diceHand->values();
        $exp = null;
        $this->assertEquals($exp, $res[0]);
    }



    /**
     * Construct object, roll and check values as well as graphics.
     */
    public function testCreateObjectAndTestRollValuesGraphic()
    {
        $diceHand = new DiceHand(1);

        $diceHand->roll();                  //Make roll
        $value = $diceHand->values();

        $arr = array(1, 2, 3, 4, 5, 6);
        $res = in_array($value[0], $arr);

        $this->assertEquals(true, $res);    //Test rolled values

        $exp = "dice-" . $value[0];
        $res = $diceHand->graphic();

        $this->assertEquals($exp, $res[0]);    //Test rolled graphic
    }



    /**
     * Construct object, roll the dices and get sum and average.
     */
    public function testCreateObjectAndTestSumAndAvg()
    {
        $diceHand = new DiceHand(2);

        $diceHand->roll();
        $value = $diceHand->values();

        $exp = $value[0] + $value[1];
        $res = $diceHand->sum();

        $this->assertEquals($exp, $res);

        $exp = ($value[0] + $value[1]) / 2;
        $res = $diceHand->average();

        $this->assertEquals($exp, $res);
    }
}
