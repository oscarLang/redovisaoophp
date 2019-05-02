<?php

namespace Osln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test player class.
 */
class ProtocolTest extends TestCase
{
    public function testConstruct()
    {
        $prot = new Protocol();
        $this->assertInstanceOf("\Osln\Dice\Protocol", $prot);
        $this->assertEquals($prot->getCurrentAsString(), "Player");
    }

    public function testWhoIsCurrent()
    {
        $prot = new Protocol();
        $exp = "Bot";
        $this->assertEquals($exp, $prot->save($prot->getCurrentAsString()));
        $exp = "Player";
        $this->assertEquals($exp, $prot->save($prot->getCurrentAsString()));
        $this->assertNull($prot->save("NoOne"));
    }

    public function testGetScores()
    {
        $prot = new Protocol();
        $zero = 0;
        $scores = array(
            'PlayerRoundScore' => $zero,
            'PlayerScore' => $zero,
            'BotRoundScore' => $zero,
            'BotScore' => $zero
        );
        $this->assertEquals($scores, $prot->getScores());
    }

    public function testPlay()
    {
        $prot = new Protocol();
        $prot->play();
        $faces = $prot->getLatestRolls();
        if (in_array(1, $faces)) {
            $this->assertEquals("Bot", $prot->getCurrentAsString());
        } else {
            $this->assertEquals("Player", $prot->getCurrentAsString());
        }
    }

    public function testWinner()
    {
        $prot = new Protocol();
        while (!$prot->hasWinner()) {
            $prot->play();
        }
        $scores = $prot->getScores();
        $playerScore = $scores["PlayerScore"];
        $botScore = $scores["BotScore"];
        if ($playerScore > $botScore) {
            $this->assertEquals("Player", $prot->hasWinner());
        } else {
            $this->assertEquals("Bot", $prot->hasWinner());
        }
    }
}
