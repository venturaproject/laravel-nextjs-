<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Update;

class UpdateProductDTO
{
    public string $name;

    public ?string $description;

    public float $price;

    public ?string $date_add;

    public function __construct(string $name, ?string $description, float $price, ?string $date_add)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->date_add = $date_add;
    }
}
