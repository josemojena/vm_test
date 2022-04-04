<?php

namespace VmApp\Domain\Model\Product;

use Ramsey\Uuid\Uuid;

class ProductId
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

    public function __toString(): string
    {
        return $this->id();
    }
    public function equals(ProductId $pId){
        return $this->id == $pId->id();
    }
}