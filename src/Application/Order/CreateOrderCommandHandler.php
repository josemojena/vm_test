<?php

namespace VmApp\Application\Order;

use VmApp\Domain\Model\CoinStock\ICoinStockRepository;
use VmApp\Domain\Model\Product\IProductRepository;
use VmApp\Domain\Model\Product\Money;
use VmApp\Domain\Model\Product\Product;
use VmApp\Domain\Model\Product\ProductNotFoundException;
use VmApp\Domain\Model\Sales\CreateOrderCommand;
use VmApp\Domain\Model\Sales\GetItemResponse;
use VmApp\Domain\Model\Sales\IMoneyChangeCalculator;
use VmApp\Domain\Model\Sales\NotAvailableChange;
use VmApp\Domain\Model\Sales\NotEnoughMoneyException;
use VmApp\Domain\Model\Sales\Order;
use VmApp\Domain\Model\Sales\OutOfStockException;
use VmApp\Domain\Model\Sales\SalesCoinStock;
use VmApp\Infrastructure\Repositories\OrderRepository;

class CreateOrderCommandHandler
{
    public function __construct(
        private IMoneyChangeCalculator $changeCalculator,
        private IProductRepository     $productRepository,
        private OrderRepository        $orderRepository,
        private ICoinStockRepository   $coinStockRepository)
    {
    }

    /**
     * @throws ProductNotFoundException
     * @throws OutOfStockException
     * @throws \Exception
     */
    public function handle(CreateOrderCommand $request): GetItemResponse
    {
        $product = $this->findProductOrThrow($request);
        $userBalance = Money::fromCoins($request->coins());
        //make an order
        $order = new Order($product->id(), $product->name(), $product->selector(), $product->price()->value(), $userBalance->value());
        $coinsStock = $this->getCurrentCoinStock();
        list($wasChangedOk, $change) = $this->changeCalculator->calculateChange($order->cost(), $userBalance->value(), $coinsStock);

        if (!$wasChangedOk) {
            throw new NotAvailableChange();
        }
        $this->orderRepository->add($order);

        //these options could be done by using domain events in order to separate side effect services actions(next version)
        //DomainEvent.raise(OrderCreated)
        $product->decreaseStock();
        $this->productRepository->update($product);
        return new GetItemResponse(productName: $order->productName(), change: $change);
    }

    /**
     * @throws ProductNotFoundException
     */
    private function findOrThrow($code): Product
    {
        $product = $this->productRepository->findByCode($code);
        if (!$product) {
            throw new ProductNotFoundException();
        }
        return $product;
    }

    /**
     * @return SalesCoinStock[]
     */
    public function getCurrentCoinStock(): array
    {
        $coinStock = $this->coinStockRepository->stock();
        $orderCoinStock = [];
        foreach ($coinStock as $item) {
            $orderCoinStock [] = new SalesCoinStock($item->id(), $item->coin()->value(), $item->amount());
        }
        return $orderCoinStock;
    }

    /**
     * @param CreateOrderCommand $request
     * @return Product
     * @throws OutOfStockException
     * @throws ProductNotFoundException
     */
    public function findProductOrThrow(CreateOrderCommand $request): Product
    {
        $product = $this->findOrThrow($request->productCode());
        if (!$product->existence()) {
            throw new OutOfStockException();
        }
        return $product;
    }


}