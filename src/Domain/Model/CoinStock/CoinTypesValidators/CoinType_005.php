<?php

namespace VmApp\Domain\Model\CoinStock\CoinTypesValidators;

use VmApp\Domain\Model\CoinStock\Coin;
use VmApp\Domain\Model\CoinStock\ICoinValueValidator;

class CoinType_005 implements ICoinValueValidator
{
    public function validate(Coin $coin): bool
    {
        return $coin->equals(Coin::fromValue(0.05));
    }
}