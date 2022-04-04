<?php

namespace VmApp\Domain\Model\CoinStock;

use http\Exception\InvalidArgumentException;

class CoinStock
{
    private CoinStockId $id;
    private Coin $coin;
    private int $amount;
    public function __construct(CoinStockId $id, Coin $coin, int $amount)
    {
        if ($amount < 0) {
            throw  new InvalidArgumentException("amount must be greater than zero");
        }

        $this->setId($id);
        $this->setCoin($coin);
        $this->setAmount($amount);
    }

    /**
     * @return Coin
     */
    public function coin(): Coin
    {
        return $this->coin;
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    public function decrease(int $value = 1)
    {
        if ($this->amount() - $value < 0) {
            $this->amount = 0;
        } else {
            $this->amount -= $value;
        }

    }

    public function id()
    {
        return $this->id;
    }

    private function setId(CoinStockId $id)
    {
        $this->id = $id;
    }

    private function setCoin(Coin $coin)
    {
        $this->coin = $coin;
    }

    private function setAmount(int $amount)
    {
        $this->amount = $amount;
    }
}