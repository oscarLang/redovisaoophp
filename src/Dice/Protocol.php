<?php
namespace Osln\Dice;

/**
 * A game of dice
 */

class Protocol
{
    private $player = new Player("Player");
    private $bot = new Player("Bot");


    public function __construct()
    {
        echo "construct";
    }

}
