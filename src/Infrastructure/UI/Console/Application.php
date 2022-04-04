<?php

namespace VmApp\Infrastructure\UI\Console;

use Exception;
use Symfony\Component\DependencyInjection\Container;
use VmApp\Application\CoinsStock\Queries\CoinStockQuery;
use VmApp\Application\Product\ProductQuery;
use VmApp\Domain\Model\Sales\CancelOrderCommand;
use VmApp\Domain\Model\Sales\CreateOrderCommand;
use VmApp\Infrastructure\UI\Console\Util\ConsoleHelper;


class Application
{
    public function __construct(private Container $container)
    {
    }

    public function bootstrap()
    {
        while (true) {
            ConsoleHelper::printTitle("Vending Machine v1.0");
            print("1- Get Item\n");
            print("2- Consulting product stock\n");
            print("3- Consulting change stock\n");
            print("4- Exit\n");

            try {
                $option = intval(readline("Option: "));
                switch ($option) {
                    case 1:
                    {
                        $this->getProduct();
                        break;
                    }
                    case 2:
                    {
                        $this->consultingProductStock();
                        break;
                    }

                    case 3:
                    {
                        $this->consultingCoinStock();
                        break;
                    }
                    case 4:
                    {
                        exit(0);
                    }
                    default:
                    {
                        throw  new \InvalidArgumentException("Invalid option");
                    }
                }

            } catch (Exception $e) {
                system("clear");
                echo "{$e->getMessage()}\n";
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getProduct()
    {
        $cliParser = new ParseInput();
        $this->promptCoinsInput();
        $coins = $cliParser->convertToCoinsFromInput($this->readCoinsInput());
        if (!$this->validateCoinsDenominations($coins)) {
            throw new \InvalidArgumentException("invalid coins denominations");
        }

        $this->promptProductSelectorInput();
        $option = $this->getValidatedOption();
        $selectors = $this->selectorOptions();
        if (!$selectors[$option]) {
            throw new Exception("invalid option");
        }
        $selector = $selectors[$option];
        $command = $cliParser->commandFromInput($coins, $selector);
        if ($command instanceof CreateOrderCommand) {
            $response = $this->container->get('createordercontroller')->execute($command);
            echo "-> $response";
            echo "\n";
        }
        if ($command instanceof CancelOrderCommand) {
            $response = $this->container->get('cancelorderhandler')->handle($command);
            echo "-> $response";
            echo "\n";
        }
    }

    private function consultingProductStock()
    {
        $response = $this->container->get('productqueryhandler')->handle(new ProductQuery());
        echo $response;
        echo "\n";
    }
    private function consultingCoinStock()
    {
        $response = $this->container->get('coinstockqueryhandler')->handle(new CoinStockQuery());
        echo $response;
        echo "\n";
    }

    private function selectorOptions(): array
    {
        return array(
            1 => "GET-SODA",
            2 => "GET-WATER",
            3 => "GET-JUICE",
            4 => "RETURN-COIN"
        );
    }
    public function getValidatedOption(): int
    {
        return intval(readline());
    }
    private function promptProductSelectorInput(): void
    {
        echo "Select the product you want\n";
        $this->printSelectors();
    }
    private function readCoinsInput(): bool|string
    {
        return readline();
    }
    private function printSelectors()
    {
        foreach ($this->selectorOptions() as $key => $selector) {
            echo "$key- $selector\n";
        }
    }
    public function promptCoinsInput(): void
    {
        echo "1- Insert coins separate comma, valid coins (0.05, 0.10, 0.25, 1)\n";
    }
    private function validateCoinsDenominations(array $coins): bool
    {
        foreach ($coins as $coin) {
            if (!$this->container->get('coinvalidator')->validate($coin)) {
                return false;
            }
        }
        return true;
    }
}