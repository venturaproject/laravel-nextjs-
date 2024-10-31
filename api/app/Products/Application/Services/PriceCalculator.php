<?php

declare(strict_types=1);

namespace App\Products\Application\Services;

class PriceCalculator
{
    public function calculateFinalPrice(float $basePrice, float $discount): float
    {
        return $basePrice - ($basePrice * ($discount / 100));
    }
}
