<?php

declare(strict_types=1);

namespace App\Products\Domain\Events;

use App\Products\Domain\Model\Product;

class ProductCreated
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
