<?php

$header = file_get_contents('tpl/table-header.html');
$footer = file_get_contents('tpl/table-footer.html');

print $header;

foreach (range(0, 9) as $first)
{
    print "<div>";

    foreach (range(0, 9) as $second)
        printf("%d * %d = %d<br>\n", $first, $second, $first * $second);

    print "</div>\n";
}

print  $footer;