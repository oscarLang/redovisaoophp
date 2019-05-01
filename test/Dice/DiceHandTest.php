<?php

namespace Osln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test dicehand clss.
 */
class DiceHandTest extends TestCase
{

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testConstructNoArguments()
    {
        $dices = new DiceHand();
        $this->assertInstanceOf("\Osln\Dice\DiceHand", $dices);

        $res = $dices->values();
        $count = sizeof($res);
        $exp = 5;
        $this->assertEquals($exp, $count);
        for ($i=0; $i < $count; $i++) {
            $this->assertNull($res[$i]);
        }
    }

    public function testSum()
    {
        $dices = new DiceHand();
        $dices->roll();

        $faces = $dices->values();
        $exp = array_sum($faces);
        $res = $dices->sum();
        $this->assertEquals($exp, $res);
    }

    public function testAverage()
    {
        $dices = new DiceHand();
        $dices->roll();

        $faces = $dices->values();
        $exp = array_sum($faces) / sizeof($faces);
        $res = $dices->average();
        $this->assertEquals($exp, $res);
    }
}
