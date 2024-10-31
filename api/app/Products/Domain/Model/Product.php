<?php

namespace App\Products\Domain\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @method static Product|null find($id)
 * @method static Product create(array<string, mixed> $attributes = [])
 * @method static Collection<int, Product> all($columns = ['*']) 
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'date_add',
    ];

    // Getter for name
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    // Getter for price
    public function getPrice(): float
    {
        return (float) $this->attributes['price'];
    }

    // Setter for price
    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }
}
