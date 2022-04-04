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
     * @param Order $order
     * @return mixed
     */
    public function addOrder(Order $order);

    /**
     * @param Product $product
     * @return mixed
     */
    public function updateProduct(Product $product): mixed;

}