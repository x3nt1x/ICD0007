<?php

class OrderLineDao
{
    public string $filePath;
    private array $orderLines;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->orderLines = [];

        $this->setOrderLines();
    }

    private function setOrderLines(): void
    {
        $lines = file($this->filePath);

        foreach ($lines as $line)
        {
            [$name, $price, $inStock] = explode(';', trim($line));

            $price = floatval($price);
            $inStock = $inStock === 'true';

            $this->orderLines[] = new OrderLine($name, $price, $inStock);
        }
    }

    public function getOrderLines(): array
    {
        return $this->orderLines;
    }
}