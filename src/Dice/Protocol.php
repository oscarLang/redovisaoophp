<?php
namespace Osln\Dice;

/**
 * A game of dice
 */

class Protocol
{
    private $player;
    private $bot;
    private $current;


    public function __construct()
    {
        $this->player = new Player("Player");
        $this->bot = new Player("Bot");
        $this->current = "Player";
        echo "construct";
    }

    public function chooseStarter()
    {
        $winner = false;
        while(!$winner) {
            $faceOfPlayer = $this->player->playRound();
            $faceOfBot = $this->bot->playRound();
            if ($faceOfPlayer > $faceOfBot) {
                $winner = true;
                $this->current = "Player";
                return "player starts";
            } elseif ($faceOfBot > $faceOfPlayer) {
                $winner = true;
                $this->current = "Bot";
                return "bot starts";
            }
        }
    }

    private function whoIsCurrent()
    {
        // var_dump($this->current);
        if($this->current == $this->player->getName()) {
            return $this->player;
        } elseif ($this->current == $this->bot->getName()) {
            return $this->bot;
        }
    }

    public function getCurrentAsString() : string
    {
        return $this->current;
    }

    private function swap()
    {
        if ($this->current == "Player") {
            $this->current = "Bot";
        } else {
            $this->current = "Player";
        }
    }

    public function play()
    {
        $currentPlayer = $this->whoIscurrent();
        $faces = $currentPlayer->playRound();
        if (in_array(1, $faces)) {
            $status = $this->player->getName() . " rolled a 1. Swapping players";
            $this->swap();
            array_push($faces, $status);
        }
        return $faces;
    }

    public function save()
    {
        if($this->current == "Player") {
            $this->player->stay();
        } else {
            $this->bot->stay();
        }
        $this->swap();
    }

}
