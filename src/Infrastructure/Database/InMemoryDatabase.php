<?php

namespace VmApp\Infrastructure\Database;

use VmApp\Domain\Model\CoinStock\Coin;
use VmApp\Domain\Model\CoinStock\CoinStock;
use VmApp\Domain\Model\CoinStock\CoinStockId;
use VmApp\Domain\Model\Product\Money;
use VmApp\Domain\Model\Product\Product;
use VmApp\Domain\Model\Product\ProductId;
use VmApp\Domain\Model\Sales\Order;

/**
 *  Fake database keeps data in memory while the process is alive
 */
class InMemoryDatabase implements IDatabase
{
    /**
     * @var Product[]
     */
    private array $products;
    /**
     * @var CoinStock[]
     */
    private array $coins = [];
    /**
     * @var Order[]
     */
    private array $orders = [];

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        //this data could be loaded from database, file,etc
        $this->products = [
            new Product(id: new ProductId(), name: "Water", price: new Money(0.65), selector: "GET-WATER", availableStock: 5),
            new Product(id: new ProductId(), name: "Juice", price: new Money(1.0), selector: "GET-JUICE", availableStock: 10),
            new Product(id: new ProductId(), name: "Soda", price: new Money(1.50), selector: "GET-SODA", availableStock: 10)];

        $this->coins = [
            new CoinStock(id: new CoinStockId(), coin: new Coin(0.05), amount: 10),
            new CoinStock(id: new CoinStockId(), coin: new Coin(0.10), amount: 10),
            new CoinStock(id: new CoinStockId(), coin: new Coin(0.25), amount: 10),
            new CoinStock(id: new CoinStockId(), coin: new Coin(1.0), amount: 15)
        ];
    }
    /**
     * @return CoinStock[]
     */
    public function getCoinsStock(): array
    {
        return $this->coins;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        //Every time getProducts is called is like a database access, so in
        //order to simulate that behavior we are going to make a product new version for each selection
        //and that way avoid the scape analysis to this objects
        $makeCopyProduct = function (Product $product): Product {
            return clone $product;
        };
        return array_map($makeCopyProduct, $this->products);
    }

    /**
     * Update a model(Product|Coin) into memory array of data
     * @param Product $product
     * @return void
     */
    public function updateProduct(Product $product)
    {
        //fool example of update... just for the test
        foreach ($this->products as $index => $prod) {
            if ($prod->id() === $product->id()) {
                $this->products[$index] = $product;
                break;
            }
        }
    }

    public function addOrder(Order $order)
    {
        $this->orders [] = $order;
    }
}