<?php

function isInList($list, int $target): bool
{
    return count(array_filter($list, fn($number) => $number === $target)) != 0;

    /*
    foreach ($list as $number)
    {
        if ($number === $target)
            return true;
    }

    return false;
    */
}

var_dump(isInList([1, 2, 3], 2)); // true
var_dump(isInList([1, 2, 3], 4)); // false