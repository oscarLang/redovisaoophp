<?php

namespace Osln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test bot class.
 */
class BotTest extends TestCase
{
    public function testConstructWithInherit()
    {
        $bot = new Bot("Bot");
        $this->assertInstanceOf("\Osln\Dice\Bot", $bot);

        $this->assertEquals($bot->getName(), "Bot");
    }

    public function testPlay()
    {
        $bot = new Bot("Bot");
        while ($bot->getRoundScore() < 30) {
            $this->assertNotEmpty($bot->playRound());
        }
    }
}
