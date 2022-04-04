<?php

namespace VmApp\Domain\Model\Sales;

use VmApp\Domain\Model\CoinStock\Coin;

interface IMoneyChangeCalculator
{
    /**
     * Calculate the amount of money to give back and return it in coins back to the user
     * @param float $productPrice
     * @param float $amountMoneyToBuyProduct
     * @param SalesCoinStock[] $availableChange
     * @return Coin[] array
     */
    public function calculateChange(float $productPrice, float $amountMoneyToBuyProduct, array $availableChange): array;

}