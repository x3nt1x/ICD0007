<?php

require_once 'vendor/tpl.php';
require_once 'Request.php';

$request = new Request($_REQUEST);

$cmd = $request->param('cmd') ?: 'ctf_form';

if (($input = $request->param('temperature')))
{
    if (!is_numeric($input))
    {
        $data = [
            'temperature' => $input,
            'template' => 'ex3_form.html',
            'error' => 'Input must be a number',
            'cmd' => $cmd === 'ctf_form' ? 'ctf_calculate' : 'ftc_calculate'
        ];

        print renderTemplate('tpl/ex3_main.html', $data);

        exit();
    }
}

if ($cmd === 'ctf_form')
{
    $data = ['template' => 'ex3_form.html', 'cmd' => 'ctf_calculate'];

    print renderTemplate('tpl/ex3_main.html', $data);
}
else if ($cmd === 'ftc_form')
{
    $data = ['template' => 'ex3_form.html', 'cmd' => 'ftc_calculate'];

    print renderTemplate('tpl/ex3_main.html', $data);
}
else if ($cmd === 'ctf_calculate')
{
    $result = celsiusToFahrenheit($input);
    $message = "$input degrees in Celsius is $result degrees in Fahrenheit";

    $data = ['template' => 'ex3_result.html', 'message' => $message];

    print renderTemplate('tpl/ex3_main.html', $data);
}
else if ($cmd === 'ftc_calculate')
{
    $result = fahrenheitToCelsius($input);
    $message = "$input degrees in Fahrenheit is $result degrees in Celsius";

    $data = ['template' => 'ex3_result.html', 'message' => $message];

    print renderTemplate('tpl/ex3_main.html', $data);
}

function celsiusToFahrenheit($temp): float
{
    return round($temp * 9 / 5 + 32, 2);
}

function fahrenheitToCelsius($temp): float
{
    return round(($temp - 32) / (9 / 5), 2);
}