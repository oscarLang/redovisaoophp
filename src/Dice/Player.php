<?php
namespace Osln\Dice;

/**
 * A game of dice
 */
class Player
{
    protected $name;
    protected $currentScore;
    protected $roundScore;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->currentScore = 0;
        $this->roundScore = 0;
    }

    public function playRound()
    {
        $dices = new DiceHand();
        $dices->roll();
        $faces = $dices->values();
        foreach ($faces as $face) {
            if ($face == 1) {
                $this->roundScore = 0;
                return $faces;
            }
        }
        $this->roundScore += $dices->sum();
        return $faces;
    }

    public function stay()
    {
        $this->currentScore += $this->roundScore;
        $this->roundScore = 0;
        return $this->currentScore;
    }

    public function getTotalScore()
    {
        return $this->currentScore;
    }

    public function getRoundScore()
    {
        return $this->roundScore;
    }

    public function getName() : string
    {
        return $this->name;
    }
}
