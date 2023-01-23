<?php

// read customer code from program parameters
$code = $argv[1];

// use database.php to get customer info from customer code
// use display.php to convert the data to human-readable form
// print the converted data.
print shell_exec("php .\customer\database.php {$code}");