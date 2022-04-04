<?php

namespace VmApp\Domain\Model\Product;

interface IProductRepository
{
    /**
     * Product[]
     * @return mixed
     */
    public function findAll(): mixed;

    /**
     * @param $productCode
     * @return mixed
     */
    public function findByCode($productCode): mixed;

    /**
     * @param Product $product
     * @return void
     */
    public function update(Product $product): void;

}