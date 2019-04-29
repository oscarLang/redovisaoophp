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
    private $latestRoll;
    private $winner;

    public function __construct()
    {
        $this->player = new Player("Player");
        $this->bot = new Bot("Bot");
        $this->current = "Player";
        $this->winner = null;
    }

    public function chooseStarter()
    {
        $winner = false;
        while(!$winner) {
            $faceOfPlayer = array_sum($this->player->playRound());
            $faceOfBot = array_sum($this->bot->playRound());
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

    private function swap(string $from)
    {
        if ($from == $this->player->getName()) {
            $this->current = "Bot";
        } elseif($from == $this->bot->getName()) {
            $this->current = "Player";
        }
        return $this->current;
    }

    public function play()
    {
        $currentPlayer = $this->whoIscurrent();
        $faces = $currentPlayer->playRound();
        if (in_array(1, $faces)) {
            $status = $currentPlayer->getName() . " rolled a 1. Swapping players";
            $this->swap($currentPlayer->getName());
            array_push($faces, $status);
        }
        if (($currentPlayer->getRoundScore() > 30) and ($currentPlayer->getName() == "Bot")) {
            $status = "Bot rolled " . $currentPlayer->getRoundScore() . " and decided to stay";
            array_push($faces, $status);
            $this->save("Bot");
            // $this->swap($currentPlayer->getName());
        }
        if ($this->$currentPlayer->getTotalScore() >= 100) {
            $this->winner = $currentPlayer->getName();
        }
        $this->latestRoll = $faces;
        return $faces;
    }

    public function save(string $toSave)
    {
        if($toSave == $this->player->getName()) {
            $this->player->stay();
            $this->swap("Player");
        } elseif($toSave == $this->bot->getName()) {
            $this->bot->stay();
            $this->swap("Bot");
        }
    }

    public function getLatestRolls()
    {
        return $this->latestRoll;
    }

    public function getScores()
    {
        $scores = array(
            'PlayerRoundScore' => $this->player->getRoundScore(),
            'PlayerScore' => $this->player->getTotalScore(),
            'BotRoundScore' => $this->bot->getRoundScore(),
            'BotScore' => $this->bot->getTotalScore()
        );;
        return $scores;
    }

    public function hasWinner()
    {
        return $this->winner;
    }

}
