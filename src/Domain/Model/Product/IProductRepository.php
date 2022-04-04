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
     * ?Product
     * @param $productCode
     * @return mixed
     */
    public function findByCode($productCode): mixed;

    public function remove(Product $product): void;

    public function update(Product $product): void;

}