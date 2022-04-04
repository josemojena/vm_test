<?php

namespace VmApp\Domain\Model\Sales;

class CancelOrderCommand
{
    private array $coins;
    public function __construct(array $coins)
    {
        $this->coins = $coins;
    }

    /**
     * @return array
     */
    public function coins(): array
    {
        return $this->coins;
    }
}