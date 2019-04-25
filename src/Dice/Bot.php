<?php
namespace Osln\Dice;

/**
 * A game of dice
 */
class Bot extends Player
{

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function playRound()
    {
        $dices = new DiceHand();
        $faces = [];
        while(true) {
            $dices->roll();
            $faces = $dices->values();
            if (!in_array(1, $faces)) {
                $this->roundScore += $dices->sum();
            } else {
                $this->roundScore = 0;
                break;
            }
            if ($this->roundScore > 30) {
                break;
            }
        }
        return $faces;
    }
}
