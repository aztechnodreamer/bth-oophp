<?php

namespace Seva19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceHistogramCreateObjectTest extends TestCase
{
    /**
     * Construct object and test method getHistogramMax().
     */
    public function testCreateObjectGetHistogramMax()
    {
        $diceHistogram = new DiceHistogram();
        $this->assertInstanceOf("\Seva19\Dice\DiceHistogram", $diceHistogram);

        $res = $diceHistogram->getHistogramMax();
        $exp = 6;

        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and test methods updateSerie() and getHistogramSerie().
     */
    public function testCreateObjectUpdateAndGetSerie()
    {
        $diceHistogram = new DiceHistogram();
        $this->assertInstanceOf("\Seva19\Dice\DiceHistogram", $diceHistogram);

        $exp = array(1, 2, 3, 4, 5, 6);
        $diceHistogram->updateSerie($exp);

        $res = $diceHistogram->getHistogramSerie();

        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and test methods getHistogramMin().
     */
    public function testCreateObjectGetMin()
    {
        $diceHistogram = new DiceHistogram();
        $this->assertInstanceOf("\Seva19\Dice\DiceHistogram", $diceHistogram);

        $res = $diceHistogram->getHistogramMin();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }



    // /**
    //  * Construct object and test methods getHistogramMax().
    //  */
    // public function testCreateObjectGetMax()
    // {
    //     $diceHistogram = new DiceHistogram();
    //     $this->assertInstanceOf("\Seva19\Dice\DiceHistogram", $diceHistogram);
    //
    //     $arr = array(1, 2, 3, 4, 5, 6);
    //     $diceHistogram->updateSerie($arr);
    //
    //     $res = $diceHistogram->getHistogramMax();
    //     $exp = 6;
    //     $this->assertEquals($exp, $res);
    // }
}
