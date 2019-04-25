<?php
namespace Osln\Dice;

/**
 * A game of dice
 */

class Protocol
{
    private $player;
    private $bot;
    private $next;


    public function __construct()
    {
        $this->player = new Player("Player");
        $this->bot = new Player("Bot");
        $this->next = "Player";
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
                $this->next = "Player";
                return "player starts";
            } elseif ($faceOfBot > $faceOfPlayer) {
                $winner = true;
                $this->next = "Bot";
                return "bot starts";
            }
        }
    }

    private function whoIsNext()
    {
        var_dump($this->next);
        if($this->next == $this->player->getName()) {
            return $this->player;
        } elseif ($this->next == $this->bot->getName()) {
            return $this->bot;
        }
    }

    private function getNextAsString() : string
    {
        return $this->next;
    }

    private function swap()
    {
        if ($this->next == "Player") {
            $this->next = "Bot";
        } else {
            $this->next = "Player";
        }
    }

    public function play()
    {
        $nextPlayer = $this->whoIsNext();
        // var_dump($nextPlayer);
        if (!$nextPlayer->playRound()) {
            $status = $this->player->getName() . " rolled 1. Swapping players";
            $this->swap();
            return $status;
        } else {
            return $this->player->getName() . " rolled " . $this->player->getRoundScore();
        }
    }

}
