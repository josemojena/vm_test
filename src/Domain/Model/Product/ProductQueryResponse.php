<?php

namespace VmApp\Domain\Model\Product;

class ProductQueryResponse
{
    /**
     * @var Product[]
     */
    private array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function __toString(): string
    {
        if (count($this->products) == 0) {
            return "Product stock empty";
        }
        $productsDto = array_map(function ($item) {
            return sprintf("Product: %s  | Price: %s | Stock: %d", $item->name(), $item->price(), $item->quantity());
        }, $this->products);

        return implode("\n", $productsDto);
    }
}