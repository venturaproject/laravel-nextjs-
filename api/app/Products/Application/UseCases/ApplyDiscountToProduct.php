<?php

declare(strict_types=1);

namespace App\Products\Application\UseCases;

use App\Products\Domain\Model\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;

class ApplyDiscountToProduct
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(int $productId, float $discountPercentage): Product
    {
        // Retrieve the product by ID
        $product = $this->productRepository->findById($productId);

        // Check if the product exists
        if ($product === null) {
            throw new \InvalidArgumentException("Product not found.");
        }

        // Apply the discount
        $discountedPrice = $product->getPrice() - ($product->getPrice() * ($discountPercentage / 100));
        $product->setPrice($discountedPrice);

        // Save the updated product
        $this->productRepository->save($product);

        return $product;
    }
}
