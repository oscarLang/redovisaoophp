<?php

namespace Osln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test player class.
 */
class PlayerTest extends TestCase
{
    /**
    * Test constructing a PLayer without arguments and then calling
    * getName
    * @expectedException TypeError
     */
    public function testConstructFail()
    {
        $player = new Player();
        $this->assertInstanceOf("\Osln\Dice\Player", $player);

        $this->assertEquals($player->getName(), "Player");
    }

    public function testConstructWithArguments()
    {
        $player = new Player("Player");
        $this->assertInstanceOf("\Osln\Dice\Player", $player);

        $this->assertEquals($player->getName(), "Player");
    }

    public function testRound()
    {
        for ($i=0; $i < 100; $i++) {
            $player = new Player("Player");
            $faces = $player->playRound();
            if (in_array(1, $faces)) {
                $this->assertEquals($player->getRoundScore(), 0);
            } else {
                $sum = array_sum($faces);
                $this->assertEquals($player->getRoundScore(), $sum);
            }
        }
    }

    public function testStay()
    {

        while (true) {
            $player = new Player("Player");
            $faces = $player->playRound();
            if (!in_array(1, $faces)) {
                $roundScore = $player->getRoundScore();
                $player->stay();
                $totalScore = $player->getTotalScore();
                $this->assertEquals($roundScore, $totalScore);
                break;
            }
        }
    }
}
