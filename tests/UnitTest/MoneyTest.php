<?php

namespace tests\UnitTest;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use VmApp\Domain\Model\Product\Money;

class MoneyTest extends TestCase
{
    public function testEqualsFromValue()
    {
        $money = Money::fromValue(1.0);
        $this->assertEquals($money, Money::fromValue(1.0));
    }

    public function testCanNotCreateWithNegativeValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $money = Money::fromValue(-10);
    }

    public function testSumOfMoneyWasOK()
    {
        $m1 = Money::fromValue(0.35);
        $m2 = Money::fromValue(0.10);
        $this->assertEquals(Money::fromValue(0.45), $m1->add($m2));
    }

    public function testSubstractOfMoneyWasOK()
    {
        $m1 = Money::fromValue(0.35);
        $m2 = Money::fromValue(0.10);
        $this->assertEquals(Money::fromValue(0.25), $m1->subtract($m2));
    }

    public function testSubstractOfMoneyWithResultZeroWasOK()
    {
        $m1 = Money::fromValue(0.05);
        $m2 = Money::fromValue(0.05);
        $this->assertEquals(Money::fromValue(0), $m1->subtract($m2));
    }
}