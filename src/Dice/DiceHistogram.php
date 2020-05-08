<?php

namespace Seva19\Dice;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram extends Dice implements HistogramInterface
{
    use HistogramTrait;


    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return 6;       //$this->sides;
    }


    /**
     * Update the serie with latest diceroll.
     *
     * @return void.
     */
    public function updateSerie($values)
    {
        for ($i = 0; $i < count($values); $i++) {
            $this->serie[] = $values[$i];
        }
    }
}
