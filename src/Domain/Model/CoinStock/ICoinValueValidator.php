<?php

namespace VmApp\Domain\Model\CoinStock;

interface ICoinValueValidator
{
//  public function setCoin(Coin $coin): void;
  public function validate(Coin $coin): bool;
}