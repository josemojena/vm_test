<?php

namespace VmApp\Domain\Model\Sales;

enum OrderStatus
{
    case created;
    case confirmed;
    case canceled;
}