<?php
namespace Osln\Dice;

/**
 * A game of dice
 */
class Dice
{
    /**
    *@var integer $face The number facing up, if null randomise
    **/
    private $face;
    const SIDES = 6;


    /**
     * Constructor to create a Dice.
     *
     * @param null|int $face The face of the dice.
     */
    public function __construct(int $face = null)
    {
        if ($face == null) {
            $this->face = rand(1, self::SIDES);
        } else {
            $this->face = $face;
        }
    }
    /**
     * roll the dice.
     *
     * @return int The face of the dice after a roll.
     */
    public function roll()
    {
        $this->face = rand(1, self::SIDES);
        return $this->face;
    }

    /**
     * @return int The face of the dice.
     */
    public function get_last_roll()
    {
        return $this->face;
    }
}
