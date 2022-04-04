<?php

namespace UnitTest;

use PHPUnit\Framework\TestCase;
use VmApp\Domain\Model\CoinStock\Coin;
use VmApp\Domain\Model\CoinStock\CoinStock;
use VmApp\Domain\Model\CoinStock\CoinStockId;
use VmApp\Domain\Model\Product\Money;
use VmApp\Domain\Model\Product\Product;
use VmApp\Domain\Model\Product\ProductId;
use VmApp\Domain\Model\Sales\MoneyChangeCalculator;
use VmApp\Domain\Model\Sales\NotEnoughMoneyException;
use VmApp\Domain\Model\Sales\Order;

class GetProductTest extends TestCase
{

    var array $coinStock;

    public function setUp(): void
    {
        parent::setUp();
        $this->coinStock = [
            new CoinStock(id: new CoinStockId(), coin: new Coin(0.05), amount: 10),
            new CoinStock(id: new CoinStockId(), coin: new Coin(0.10), amount: 10),
            new CoinStock(id: new CoinStockId(), coin: new Coin(0.25), amount: 10),
            new CoinStock(id: new CoinStockId(), coin: new Coin(1.0), amount: 15)
        ];
    }

    public function testOrderNotCreatedNotEnoughMoney()
    {

        $this->expectException(NotEnoughMoneyException::class);
        $userBalance = Money::fromCoins([Coin::fromValue(0.10)]);
        $product = new Product(id: new ProductId(), name: "Juice", price: new Money(1.0), selector: "GET-JUICE", availableStock: 10);
        $order = new Order($product->id(), $product->name(), $product->selector(), $product->price()->value(), $userBalance->value());
    }

    public function testOrderCreatedOk()
    {

        $this->expectException(NotEnoughMoneyException::class);
        $userBalance = Money::fromCoins([Coin::fromValue(0.10)]);
        $product = new Product(id: new ProductId(), name: "Juice", price: new Money(1.0), selector: "GET-JUICE", availableStock: 10);
        $order = new Order($product->id(), $product->name(), $product->selector(), $product->price()->value(), $userBalance->value());
        $this->assertInstanceOf(Order::class);
    }

}