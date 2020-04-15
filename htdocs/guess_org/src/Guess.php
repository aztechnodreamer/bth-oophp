<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number;
    private $tries;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        // Set secret number
        if ($number == -1) {
            $this->random();
        } else {
            $this->number = $number;
        }

        // Set number of tries
        $this->tries = $tries;
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    public function random()
    {
        $this->number = rand(1, 100);
    }


    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries() : int
    {
        return $this->tries;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number() : int
    {
        return $this->number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($guess)
    {
        if ($this->tries > 1) {
            if (($guess >= 1) && ($guess <= 100)) {
                $this->tries -= 1;
                if ($guess == $this->number) {
                    $this->tries = 0;
                    $res = "Congratulations! Your guess " . $guess . " is <b>CORRECT</b>.<br />Press 'New Game' to play again.";
                } elseif ($guess > $this->number) {
                    $res = "Sorry, your guess " . $guess . " is <b>TOO HIGH</b>";
                } else {
                    $res = "Sorry, your guess " . $guess . " is <b>TOO LOW</b>";
                }
            } else {
                throw new GuessException("Guess must be a number between 1 and 100.");
            }
        } elseif (($this->tries == 1) && ($guess == $this->number)) {
            $this->tries = 0;
            $res = "Congratulations! Your guess " . $guess . " is <b>CORRECT</b>.<br />Press 'New Game' to play again.";
        } else {
            $this->tries = 0;
            $res = "<b>No guesses remains!</b> Press 'New Game' to play again.";
        }

        return $res;
    }
}