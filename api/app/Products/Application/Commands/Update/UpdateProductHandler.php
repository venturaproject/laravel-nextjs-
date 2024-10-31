<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Update;

use App\Products\Application\Commands\Update\UpdateProduct;
use App\Products\Domain\Model\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(UpdateProduct $command): Product
    {
    
        $product = $this->productRepository->findById($command->id);

        if (!$product) {
            throw new ModelNotFoundException("Product not found");
        }

        $product->update(array_filter([
            'name' => $command->dto->name,
            'description' => $command->dto->description,
            'price' => $command->dto->price,
            'date_add' => $command->dto->date_add,
        ]));

        return $product;
    }
}
