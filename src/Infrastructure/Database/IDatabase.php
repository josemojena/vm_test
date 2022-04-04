<?php

namespace VmApp\Infrastructure\Database;

use VmApp\Domain\Model\CoinStock\Coin;
use VmApp\Domain\Model\CoinStock\CoinStock;
use VmApp\Domain\Model\Product\Product;
use VmApp\Domain\Model\Sales\Order;

interface IDatabase
{

    /**
     * @return Product[]
     */
    public function getProducts(): array;

    /**
     * @return CoinStock[]
     */
    public function getCoinsStock(): array;

    /**
     * @param CoinStock $coin
     * @return void
     */
    public function setCoinStock(CoinStock $coin): void;

    public function addOrder(Order $order);

    public function updateProduct(Product $product);

}