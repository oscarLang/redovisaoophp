<?php

namespace Osln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test dice class.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testConstructNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Osln\Dice\Dice", $dice);

        $res = $dice->getLastRoll();
        $this->assertGreaterThan(0, $res);
        $this->assertLessThan(7, $res);
    }
    /**
     * Construct object and verify that the object has the expected
     * properties. Use arguments.
     */
    public function testConstructWithArguments()
    {
        $dice = new Dice(3);
        $this->assertInstanceOf("\Osln\Dice\Dice", $dice);

        $res = $dice->getLastRoll();
        $exp = 3;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test function roll(). Should return a number between 0 and 7.
     */
    public function testDiceRoll()
    {
        $dice = new Dice(3);
        for ($i=0; $i < 100; $i++) {
            $res = $dice->roll();
            $this->assertGreaterThan(0, $res);
            $this->assertLessThan(7, $res);
        }
    }
}
