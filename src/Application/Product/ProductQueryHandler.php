<?php

namespace VmApp\Application\Product;

use VmApp\Domain\Model\Product\ProductQueryResponse;
use VmApp\Infrastructure\Repositories\ProductRepository;

class ProductQueryHandler
{
    public function __construct(private ProductRepository $productRepository)
    {

    }

    public function handle(ProductQuery $query): ProductQueryResponse
    {
        $products = $this->productRepository->findAll();
        return new ProductQueryResponse($products);
    }
}