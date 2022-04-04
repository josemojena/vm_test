<?php

namespace VmApp\Infrastructure\Repositories;


use VmApp\Domain\Model\Product\IProductRepository;
use VmApp\Domain\Model\Product\Product;
use VmApp\Infrastructure\Database\IDatabase;


class ProductRepository implements IProductRepository
{
    /**
     * @var IDatabase DataSource
     */
    private IDatabase $storage;

    public function __construct(IDatabase $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return Product[]
     */
    public function findAll(): array
    {
        return $this->storage->getProducts();
    }

    /**
     * @param $productCode
     * @return Product|null
     */
    public function findByCode($productCode): ?Product
    {
        $_products = $this->storage->getProducts();
        foreach ($_products as $product) {
            if ($product->selector() == $productCode) {
                return $product;
            }
        }
        return null;
    }
    public function update(Product $product): void
    {
        $this->storage->updateProduct($product);
    }
}