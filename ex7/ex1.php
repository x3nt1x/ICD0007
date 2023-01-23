<?php

require_once 'OrderLine.php';
require_once 'OrderLineDao.php';

$dao = new OrderLineDao('data/order.txt');

foreach ($dao->getOrderLines() as $orderLine)
{
    printf('name: %s, price: %s; in stock: %s' . PHP_EOL,
        $orderLine->productName,
        $orderLine->price,
        $orderLine->inStock ? 'true' : 'false');
}