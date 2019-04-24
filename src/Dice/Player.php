<?php
namespace Osln\Dice;

/**
 * A game of dice
 */
class Player
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
