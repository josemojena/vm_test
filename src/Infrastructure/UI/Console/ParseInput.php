<?php

namespace VmApp\Infrastructure\UI\Console;


use Exception;
use http\Exception\InvalidArgumentException;
use VmApp\Domain\Model\CoinStock\Coin;
use VmApp\Domain\Model\Sales\CreateOrderCommand;
use VmApp\Domain\Model\Sales\CancelOrderCommand;

class ParseInput
{
    /**
     * Return a command for a given input
     * @param array $coins
     * @param string $selector
     * @return CancelOrderCommand|CreateOrderCommand
     */
    public function commandFromInput(array $coins, string $selector): CancelOrderCommand|CreateOrderCommand
    {
        $cleanSelector = $this->sanitize($selector);
        return match ($cleanSelector) {
            "GET-SODA", "GET-JUICE", "GET-WATER" => new CreateOrderCommand($cleanSelector, $coins),
            "RETURN-COIN" => new CancelOrderCommand($coins),
            default => throw  new \InvalidArgumentException("Unknown option `$selector`")
        };
    }

    public function convertToCoinsFromInput(string $inputCoins): array
    {
        $coins = [];
        foreach (explode(',', $inputCoins) as $value) {
            $cleanValue = $this->sanitize($value);
            if (!is_numeric($cleanValue)) {
                throw new \InvalidArgumentException("invalid coins");
            }
            $coins[] = Coin::fromValue(floatval($cleanValue));
        }
        return $coins;
    }

    private function sanitize(string $value): string
    {
        return trim($value);
    }
}