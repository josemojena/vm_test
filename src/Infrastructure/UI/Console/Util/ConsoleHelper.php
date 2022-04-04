<?php

namespace VmApp\Infrastructure\UI\Console\Util;

class ConsoleHelper
{

    public static function printTitle($message)
    {
        print(join("", array_fill(0, 20, "*")));
        printf(" %s ", $message);
        print(join("", array_fill(0, 20, "*")));
        print("\n");
    }

    public static function printLine($message, $number = null)
    {
        if ($number == null) {
            printf("%s", $message);
        } else {
            printf("%d- %s", $number, $message);
        }


    }
}