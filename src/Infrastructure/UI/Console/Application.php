<?php

namespace VmApp\Infrastructure\UI\Console;

use Exception;
use Symfony\Component\DependencyInjection\Container;
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
            ConsoleHelper::printTitle("Vending Machine");
            print("1- Get Item\n");
            print("2- Consulting stock\n");
            print("3- Exit\n");

            try {
                $option = intval(readline("Option: "));
                switch ($option) {
                    case 1:
                    {
                        $this->areaClient();
                        break;
                    }
                    case 2:
                    {
                        $this->consultingStock();
                        break;
                    }
                    case 3:
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
     * Handle client options
     * @return void
     * @throws Exception
     */
    public function areaClient()
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
//        $input = "1, 0.25, 0.25, GET-WATER";
//        $input = "0.10, 0.10, RETURN-COIN";
//        $input = "1.0, 1.0, 1.0, 1.0, 1.0, GET-WATER";
        //$input = "1.0, 0.05, 0.10, GET-WATER";

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

    private function consultingStock()
    {
        $response = $this->container->get('productqueryhandler')->handle(new ProductQuery());
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

    /**
     * @return int
     */
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

    /**
     * @return void
     */
    public function promptCoinsInput(): void
    {
        echo "1- Insert coins separate comma, valid coins (0.05, 0.10, 0.25, 1)\n";
    }

    /**
     * @throws Exception
     */
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