<?php

$inputList = [1, 4, 2, 0];

// Create string from $inputList
$listAsString = join(", ", $inputList);

// Create list from value in $listAsString
$restoredList = array_map(fn($num) => intval($num), explode(", ", $listAsString));

// Check that the restored list is the same as the input list
var_dump($restoredList === $inputList); // bool(true)