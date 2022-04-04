<?php

namespace VmApp\Domain\Model\CoinStock;

use Ramsey\Uuid\Uuid;

class CoinStockId
{
    private string $id;

    public function __construct($id = null)
    {
        $this->id = $id !== null ? $id : Uuid::uuid4()->toString();
    }

    public function id(): string
    {
        return $this->id;
    }

}