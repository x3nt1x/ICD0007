<?php

function distributeToSets(array $input): array
{
    $result = [];

    foreach ($input as $key)
    {
        if (array_key_exists($key, $result))
            continue;

        foreach ($input as $value)
        {
            if ($key === $value)
                $result[$key][] = $value;
        }
    }

    return $result;
}