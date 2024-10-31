<?php

declare(strict_types=1);

namespace App\Products\Application\Queries\GetAll;

use App\Products\Application\Queries\GetAll\GetAllProducts;
use App\Products\Domain\Model\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetAllProductsHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Handles the query to retrieve all products.
     *
     * @param GetAllProducts $query
     * @return Collection<int, Product> Collection of Product objects
     */
    public function handle(GetAllProducts $query): Collection
    {
        return $this->productRepository->findAll();
    }
}
