<?php

namespace tests\UnitTest;

use PHPUnit\Framework\TestCase;
use VmApp\Domain\Model\CoinStock\Coin;

class CoinTest extends TestCase
{
    public function testEqualsFromValue()
    {
        $money = Coin::fromValue(0.10);
        $this->assertEquals($money, Coin::fromValue(0.10));
    }
}