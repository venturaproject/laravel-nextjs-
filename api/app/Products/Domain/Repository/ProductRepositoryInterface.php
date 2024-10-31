<?php

declare(strict_types=1);

namespace App\Products\Domain\Repository;

use App\Products\Domain\Model\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * Find all products.
     *
     * @return Collection<int, Product> Collection of Product objects
     */
    public function findAll(): Collection;

    /**
     * Create a new product.
     *
     * @param array<string, mixed> $data Associative array with the product data (e.g. ['name' => 'Product Name', 'price' => 10.99])
     * @return Product The created Product object
     */
    public function create(array $data): Product;

    /**
     * Update an existing product.
     *
     * @param Product $product The product to update
     * @param array<string, mixed> $data Associative array with the updated product data
     * @return void
     */
    public function update(Product $product, array $data): void;

    public function delete(int $id): void;

    public function findById(int $id): ?Product;

    public function save(Product $product): void;
}
