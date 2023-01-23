<?php

function getOddNumbers($list): array
{
    return array_values(array_filter($list, fn($number) => $number % 2 !== 0));

    /*
    $odd_list = [];

    foreach ($list as $number)
    {
        if ($number % 2 !== 0)
            $odd_list[] = $number;
    }

    return $odd_list;
    */
}

print_r(getOddNumbers([1, 2, 3])); // [1, 3]
print_r(getOddNumbers([1, 2, 5, 6, 2, 11, 2, 7])); // [1, 5, 11, 7]