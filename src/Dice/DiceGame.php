<?php

namespace Seva19\Dice;

/**
 * DiceGame.
 */
class DiceGame
{
    /**
     * @var integer $numDices   The number of dices in the game.
     * @var mixed   $protocol   Array with players and their dicehands and points.
     * @var string  $currPlayer The current player.
     * @var integer $sum        The sum of pips in current game round.
     */
    private $numDices;
    private $protocol;
    private $currPlayer;
    private $sum;

    /**
     * Constructor to initiate a game of dice.
     *
     * @param int $dices    Number of dices to create, default = 3.
     * @param int $players  Number of players in the game, default = 2.
     */
    public function __construct(int $dices = 3, int $players = 2)
    {
        $this->numDices = $dices;
        $this->protocol  = [];

        for ($i=0; $i < $players; $i++) {
            $name = "Player" . ($i + 1);
            $this->protocol[$name]["points"] = 0;
            $this->protocol[$name]["dicehand"] = new DiceHand($dices);
        }
    }


    /**
     * Set first player.
     *
     * @return void.
     */
    public function setFirstPlayer()
    {
        $dice = new Dice();
        $res;

        foreach ($this->protocol as $key => $value) {
            $res[$key][] = $dice->roll();
        }

        arsort($res);

        reset($res);
        $this->currPlayer = key($res);
        //$this->currPlayer = array_key_first($res);        //Ursprunglig lösning, funkade ej på studentservern.
    }


    /**
     * Get current player.
     *
     * @return string $currPlayer The current player.
     */
    public function currPlayer()
    {
        return $this->currPlayer;
    }


    /**
     * Roll the dices.
     *
     * @return array $graphics Array with the graphic result of the roll.
     */
    public function roll()
    {
        $hand = $this->protocol[$this->currPlayer]["dicehand"];

        $hand->roll();
        $values = $hand->values();
        $graphics = $hand->graphic();

        if (in_array("1", $values)) {
            $this->changePlayer();
        } else {
            $this->sum += $hand->sum();
        }
        return $graphics;
    }


    /**
     * Get sum.
     *
     * @return integer $sum The sum of pips in current game round.
     */
    public function sum()
    {
        return $this->sum;
    }


    /**
     * Update game points.
     *
     * @return void.
     */
    public function updatePoints()
    {
        $this->protocol[$this->currPlayer]["points"] += $this->sum;
    }


    /**
     * Get game protocol/record.
     *
     * @return mixed $protocol Array with players and their dicehands and points.
     */
    public function protocol()
    {
        return $this->protocol;
    }


    /**
     * Change player.
     *
     * @return void.
     */
    public function changePlayer()
    {
        $this->sum = 0;
        $playerNum = preg_replace("/[^0-9]{1,4}/", '', $this->currPlayer);
        $next = "Player" . ($playerNum + 1);

        if (array_key_exists($next, $this->protocol)) {
            $this->currPlayer = "Player" . ($playerNum + 1);
        } else {
            $this->currPlayer = "Player1";
        }
    }


    /**
     * Check winner status.
     *
     * @return string if a players has won the game.
     */
    public function checkStatus()
    {
        if ($this->protocol[$this->currPlayer]["points"] >= 100) {
            return "win";
        }
    }
}
