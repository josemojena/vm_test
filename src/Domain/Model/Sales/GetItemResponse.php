<?php

namespace VmApp\Domain\Model\Sales;

use VmApp\Domain\Model\CoinStock\Coin;

class GetItemResponse
{
    private string $productName;
    /**
     * @var Coin[]
     */
    private array $change = [];

    public function __construct(string $productName, $change = [])
    {
        $this->productName = $productName;
        $this->change = $change;
    }

    public function __toString(): string
    {
        $sResponse = $this->productName;
        if (count($this->change) > 0) {
            $sChange = implode(", ", $this->change);
            $sResponse = "$sResponse, $sChange";
        }

        return $sResponse;
    }
}