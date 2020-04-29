<?php

namespace Seva19\Dice;

/**
 * Dice.
 */
class Dice
{
    /**
     * @var integer $dice The value on the dice.
     */
    protected $dice;

    /**
     * Constructor to crate a Dice
     */
    public function __construct()
    {
        $this->dice = null;
    }


    /**
     * Roll the dice and remember tha value of the rolled dice.
     *
     * @return integer The value of the rolled dice min=1 and max=6.
     */
    public function roll()
    {
        $this->dice = rand(1, 6);
        return $this->dice;
    }


    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {
        return "dice-" . $this->dice;
    }
}
