<?php

namespace Seva19\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice   $dices   Array consisting of dices.
     * @var int    $values  Array consisting of last roll of the dices.
     * @var string $graphic Array consisting of strings representing dice graphics.
     */
    private $dices;
    private $values;
    private $graphic;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, default = 5.
     */
    public function __construct(int $dices = 5)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new Dice();
            $this->values[] = null;
        }
    }


    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        for ($i = 0; $i < count($this->dices); $i++) {
            $this->values[$i] = $this->dices[$i]->roll();
            $this->graphic[$i] = $this->dices[$i]->graphic();
        }
    }


    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }


    /**
     * Get graphic of dices from last roll.
     *
     * @return array with graphics of the last roll.
     */
    public function graphic()
    {
        return $this->graphic;
    }


    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        return array_sum($this->values);
    }


    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        $avg = array_sum($this->values) / count($this->values);
        return round($avg, 1);
    }
}
