<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Delete;

use App\Products\Application\Commands\Delete\DeleteProduct;
use App\Products\Domain\Repository\ProductRepositoryInterface;

class DeleteProductHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(DeleteProduct $command): void
    {
        // Utiliza el repositorio para buscar y eliminar el producto
        $this->productRepository->delete($command->id);
    }
}
