<?php

declare(strict_types=1);

namespace App\Products\Application\Queries\GetById;

use App\Products\Application\Queries\GetById\GetProductById;
use App\Products\Domain\Model\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Domain\Exceptions\ProductNotFoundException;

class GetProductByIdHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductById $query): ?Product
    {
       
        $product = $this->productRepository->findById($query->id);

        if (!$product) {
            throw new ProductNotFoundException(sprintf("The product with ID %d was not found.", $query->id));

        }
    
        return $product;
    }
}
