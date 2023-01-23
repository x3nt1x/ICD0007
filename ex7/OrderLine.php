<?php

class OrderLine
{
    public string $productName;
    public float $price;
    public bool $inStock;

    public function __construct($name, $price, $inStock)
    {
        $this->productName = $name;
        $this->price = $price;
        $this->inStock = $inStock;
    }
}