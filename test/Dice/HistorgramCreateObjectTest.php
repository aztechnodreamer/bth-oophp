<?php

namespace Seva19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class HistogramCreateObjectTest extends TestCase
{
    /**
     * Construct object and test method getSerie().
     */
    public function testCreateObjectGetSerie()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Seva19\Dice\Histogram", $histogram);

        $exp = array(1, 2, 3, 4, 5, 6);
        $diceHistogram = new DiceHistogram();
        $diceHistogram->updateSerie($exp);

        $histogram->injectData($diceHistogram);

        $res = $histogram->getSerie();
        $this->assertEquals($exp, $res);
    }


    /**
     * Construct object and get histogram as text.
     */
    public function testCreateObjectGetAsText()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Seva19\Dice\Histogram", $histogram);

        $arr = array(1, 2, 3, 4, 5, 6);
        $diceHistogram = new DiceHistogram();
        $diceHistogram->updateSerie($arr);

        $histogram->injectData($diceHistogram);

        $res = $histogram->getAsText();
        $exp = "1: *<br />2: *<br />3: *<br />4: *<br />5: *<br />6: *<br />";

        $this->assertEquals($exp, $res);
    }
}
