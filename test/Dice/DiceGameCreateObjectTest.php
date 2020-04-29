<?php

namespace Seva19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceGameCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $diceGame = new DiceGame();
        $this->assertInstanceOf("\Seva19\Dice\DiceGame", $diceGame);

        $arr = $diceGame->protocol();       //test protocol()

        $res = count($arr);
        $exp = 2;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use both argument.
     */
    public function testCreateObjectArguments()
    {
        $diceGame = new DiceGame(5, 5);
        $this->assertInstanceOf("\Seva19\Dice\DiceGame", $diceGame);

        $arr = $diceGame->protocol();       //test protocol()

        $res = count($arr);
        $exp = 5;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object, set first player then get current player.
     */
    public function testCreateObjectSetFirstPlayerAndGetCurrentPlayer()
    {
        $diceGame = new DiceGame();

        $res = $diceGame->currPlayer();
        $this->assertNull($res);

        $diceGame->setFirstPlayer();
        $res = $diceGame->currPlayer();
        $this->assertIsString($res);
    }



    /**
     * Construct object, roll the dices successfully and check sum.
     */
    public function testCreateObjectAndRollSuccessfully()
    {
        $diceGame = new DiceGame(3);
        $diceGame->setFirstPlayer();

        do {
            $roll = $diceGame->roll();
            $res = in_array("dice-1", $roll);
        } while ($res === true);

        $this->assertFalse($res);

        $diceGame->updatePoints();

        $arr = $diceGame->protocol();

        if ($arr["Player1"]["points"] === 0) {
            $res = $arr["Player2"]["points"];
        } else {
            $res = $arr["Player1"]["points"];
        }

        $exp = $diceGame->sum();

        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object, roll the dices unsuccessfully and check sum.
     */
    public function testCreateObjectAndRollUnsuccessfully()
    {
        $diceGame = new DiceGame(3);             //two players by default
        $diceGame->setFirstPlayer();
        $first = $diceGame->currPlayer();

        //roll until miss, which will change player
        do {
            $roll = $diceGame->roll();
            $res = in_array("dice-1", $roll);
        } while ($res != true);

        $second = $diceGame->currPlayer();
        $this->assertFalse($first === $second);

        //roll until miss again, which will change back to first player
        do {
            $roll = $diceGame->roll();
            $res = in_array("dice-1", $roll);
        } while ($res != true);

        $first = $diceGame->currPlayer();
        $this->assertFalse($first === $second);

        //Check that sum = 0
        $res = $diceGame->sum();
        $this->assertEquals(0, $res);
    }



    /**
     * Construct object, set ponits and check status with no winner.
     */
    public function testCreateObjectCheckStatusNon()
    {
        $diceGame = new DiceGame();
        $diceGame->setFirstPlayer();

        $diceGame->roll();
        $res = $diceGame->checkStatus();

        $this->assertNull($res);
    }



    /**
     * Construct object, set ponits and check status with a winner.
     */
    public function testCreateObjectCheckStatusWin()
    {
        $diceGame = new DiceGame();
        $diceGame->setFirstPlayer();

        do {
            $diceGame->roll();
            $diceGame->updatePoints();
            $player = $diceGame->currPlayer();
            $arr = $diceGame->protocol();
        } while ($arr[$player]["points"] < 100);

        $res = $diceGame->checkStatus();

        $this->assertEquals("win", $res);
    }
}
