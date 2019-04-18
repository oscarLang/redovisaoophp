<?php
namespace Osln\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number The current secret number.
     *
     * @var int $tries Number of tries a guess has been made.
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
        $this->tries = $tries;
        if ($number == -1) {
            $this->number = rand(1, 101);
        } else {
            $this->number = $number;
        }
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 101);
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
     * @param int $number The number that the player guesses
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess($number)
    {
        $state = "Your guess $number is ";
        if ($this->tries > 0) {
            if ($number > 100 || $number < 1) {
                $state = "Error";
                throw new GuessException("Number is only allowed to be positive");
            } else if ($number == $this->number) {
                $state .= "correct. You won!";
            } else if ($number > $this->number) {
                $state .= "to high";
            } else if ($number < $this->number) {
                $state .= "to low";
            }
        } else {
            $state = "No guesses left";
        }
        $this->tries -= 1;
        return $state;
    }
}
