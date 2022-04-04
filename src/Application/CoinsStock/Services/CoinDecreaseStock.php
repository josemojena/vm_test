<?php

namespace VmApp\Application\CoinsStock\Services;

use VmApp\Domain\Model\CoinStock\Coin;
use VmApp\Domain\Model\CoinStock\ICoinStockDecreaseService;
use VmApp\Domain\Model\CoinStock\ICoinStockRepository;

class CoinDecreaseStock implements ICoinStockDecreaseService
{
    public function __construct(private ICoinStockRepository $coinStockRepository)
    {

    }

    /**
     * Update the current coins stock after calculate the user' change
     * @param array $coins
     * @return mixed|void
     */
    public function decrease(array $coins)
    {
        $stock = $this->coinStockRepository->stock();
        foreach ($coins as $coin) {
            foreach ($stock as $cStock) {
                if ($cStock->coin()->equals($coin)) {
                    $cStock->decrease();
                    $this->coinStockRepository->update($cStock);
                }
            }
        }
    }
}