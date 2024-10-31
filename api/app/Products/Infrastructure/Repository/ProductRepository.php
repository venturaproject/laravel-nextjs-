<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Repository;

use App\Products\Domain\Model\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Find all products.
     *
     * @return Collection<int, Product> Collection of Product objects
     */
    public function findAll(): Collection
    {

        return Product::query()->get();
    }

    /**
     * Find a product by its ID (alias for find).
     *
     * @param int $id The ID of the product
     * @return Product|null The Product object or null if not found
     */
    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     * Create a new product.
     *
     * @param array<string, mixed> $data Associative array with the product data (e.g. ['name' => 'Product Name', 'price' => 10.99])
     * @return Product The created Product object
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update an existing product.
     *
     * @param Product $product The product to update
     * @param array<string, mixed> $data Associative array with the updated product data
     * @return void
     */
    public function update(Product $product, array $data): void
    {
        $product->update($data);
    }

    /**
     * Delete a product by its ID.
     *
     * @param int $id The ID of the product to delete
     * @return void
     */
    public function delete(int $id): void
    {
        $product = $this->findById($id);
        if ($product) {
            $product->delete();
        }
    }

    /**
     * Save a product.
     *
     * @param Product $product The product to save
     * @return void
     */
    public function save(Product $product): void
    {
        $product->save();
    }
}
