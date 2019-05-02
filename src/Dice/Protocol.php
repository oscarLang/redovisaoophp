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

    public function __construct($starter = "Player")
    {
        $this->player = new Player("Player");
        $this->bot = new Bot("Bot");
        $this->current = $starter;
    }

    public function chooseStarter()
    {
        $winner = false;
        while (!$winner) {
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
        return "Error";
    }

    private function whoIsCurrent()
    {
        if ($this->current == $this->player->getName()) {
            return $this->player;
        } elseif ($this->current == $this->bot->getName()) {
            return $this->bot;
        }
        return null;
    }

    public function getCurrentAsString() : string
    {
        return $this->current;
    }

    private function swap(string $from)
    {
        if ($from == $this->player->getName()) {
            $this->current = "Bot";
        } elseif ($from == $this->bot->getName()) {
            $this->current = "Player";
        }
        return $this->current;
    }

    public function play()
    {
        $currentPlayer = $this->whoIscurrent();
        $faces = $currentPlayer->playRound();
        $faces = $this->checkForOne($faces, $currentPlayer->getName());
        if (($currentPlayer->getRoundScore() > 30) and ($currentPlayer->getName() == "Bot")) {
            $status = "Bot rolled " . $currentPlayer->getRoundScore() . " and decided to stay";
            array_push($faces, $status);
            $this->save("Bot");
            // $this->swap($currentPlayer->getName());
        }
        $this->latestRoll = $faces;
        return $faces;
    }

    private function checkForOne($faces, $name)
    {
        if (in_array(1, $faces)) {
            $status = $name . " rolled a 1. Swapping players";
            $this->swap($name);
            array_push($faces, $status);
        }
        return $faces;
    }

    public function save(string $toSave)
    {
        if ($toSave == $this->player->getName()) {
            $this->player->stay();
            return $this->swap("Player");
        } elseif ($toSave == $this->bot->getName()) {
            $this->bot->stay();
            return $this->swap("Bot");
        }
        return null;
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
        );
        return $scores;
    }

    public function hasWinner()
    {
        $botScore = $this->bot->getTotalScore();
        $playerScore = $this->player->getTotalScore();
        if ($botScore >= 100 || $playerScore >= 100) {
            if ($botScore > $playerScore) {
                return "Bot";
            }
            return "Player";
        }
        return null;
    }
}
