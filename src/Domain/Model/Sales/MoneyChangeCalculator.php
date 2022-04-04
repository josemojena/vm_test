<?php

namespace VmApp\Domain\Model\Sales;

use Exception;
use SplPriorityQueue;

use VmApp\Domain\Model\CoinStock\CoinStock;
use VmApp\Domain\Model\Product\Money;

class MoneyChangeCalculator implements IMoneyChangeCalculator
{
    /**
     * Calculate the amount of money to give back and return it in coins back to the user
     * @param float $productPrice
     * @param float $amountMoneyToBuyProduct
     * @param SalesCoinStock[] $availableChange
     * @return array
     * @throws Exception
     */
    public function calculateChange(float $productPrice, float $amountMoneyToBuyProduct, array $availableChange): array
    {
        $moneyProductPrice = Money::fromValue($productPrice);
        $moneyToBuyProduct = Money::fromValue($amountMoneyToBuyProduct);
        $amountMoneyToReturn = $moneyToBuyProduct->subtract($moneyProductPrice);
        return $this->calculate($amountMoneyToReturn, $availableChange);
    }

    /**
     * Calculate the change for the buy of a product
     * @param Money $moneyToBuyProduct
     * @param array $stock
     * @return array
     * @throws Exception
     */
    private function calculate(Money $moneyToBuyProduct, array $stock): array
    {
        $sortedCoins = $this->sortChanges($stock);
        return $this->availableChange($moneyToBuyProduct, $sortedCoins, []);
    }

    /**
     * @param Money $m
     * @param SplPriorityQueue $change
     * @param $results
     * @return array
     */
    private function availableChange(Money $m, SplPriorityQueue $change, $results): array
    {
        if ($m->equals(Money::fromValue(0))) {
            return [true, $results];
        }
        if (!$change->valid()) {
            return [false, $results];
        }
        /**
         * @var CoinStock
         */
        $currentCoinStock = $change->extract();
        $currentMoney = Money::fromValue($currentCoinStock->coinValue());
        $total = $currentCoinStock->amount();
        if ($total != 0 && $m->greaterOrEqualThan($currentMoney)) {
            $m = $m->subtract($currentMoney);
            $results = $this->mergeChanges($results, $this->collectChanges(1, $currentCoinStock->coinValue()));
            $change->insert(new SalesCoinStock(coinStockId: $currentCoinStock->coinStockId(), coinValue: $currentCoinStock->coinValue(), amount: $currentCoinStock->amount() - 1), $currentCoinStock->coinValue());
            $change->rewind();
        }

        return $this->availableChange($m, $change, $results);

    }

    /**
     * @param SalesCoinStock[] $coinStock
     * @return SplPriorityQueue
     */
    private function sortChanges(array $coinStock): SplPriorityQueue
    {
        $sortedCoins = new \SplPriorityQueue();
        foreach ($coinStock as $coin) {
            $sortedCoins->insert($coin, $coin->coinValue());
        }

        return $sortedCoins;
    }

    /**
     * @param float $coinValue
     * @return array
     */
    private function collectChanges(int $end, float $coinValue): array
    {
        return array_fill(0, $end, $coinValue);
    }

    /**
     * @param mixed $sol
     * @param array $aNewChanges
     * @return array
     */
    private function mergeChanges(mixed $sol, array $aNewChanges): array
    {
        return array_merge($sol, $aNewChanges);
    }

//    /**
//     * @param array $coins
//     * @return \WeakMap
//     */
//    private function convertArrayCoinToMap(array $coins): \WeakMap
//    {
//        $coinsGroupByValue = new \WeakMap();
//        //make a map
//        foreach ($coins as $coin) {
//            $value = $coin->value();
//            $alreadyExist = $coinsGroupByValue->offsetExists($value);
//            $coinsGroupByValue->offsetSet($value, $alreadyExist ? $coinsGroupByValue->offsetGet($value) + 1 : 1);
//        }
//        return $coinsGroupByValue;
//    }

}