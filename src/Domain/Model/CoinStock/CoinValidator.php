<?php

namespace VmApp\Domain\Model\CoinStock;

class CoinValidator
{
    /**
     * @var ICoinValueValidator[]
     */
    private array $validators;

    public function __construct(array $coinValueValidators)
    {
        $this->validators = $coinValueValidators;
    }

    public function validate(Coin $coin): bool
    {
        foreach ($this->validators as $validator) {
            if ($validator->validate($coin)) {
                return true;
            }
        }
        return false;
    }

    public function getValidators()
    {
        return $this->validators;
    }
}