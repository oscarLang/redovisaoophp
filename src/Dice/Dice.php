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
     * Destroy a Dice.
     */
    public function __destruct()
    {
        echo __METHOD__;
    }

    public function roll()
    {
        $this->face = rand(1, self::SIDES);
        return $this->face;
    }

    public function get_last_roll()
    {
        return $this->face;
    }
}
